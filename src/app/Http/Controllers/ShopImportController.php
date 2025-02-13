<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class ShopImportController extends Controller
{
    /**
     * CSVインポートのフォームを表示
     */
    public function showImportForm()
    {
        return view('import_csv');
    }

    /**
     * CSVのデータをインポートする
     */
    public function import(Request $request)
    {
        // バリデーション（CSVファイルのチェック）
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        // CSVを読み込む
        $path = $request->file('csv_file')->store('temp');
        $file = Storage::path($path);
        $csv = Reader::createFromPath($file, 'r');
        $csv->setHeaderOffset(0);

        $allowed_areas = ['東京都', '大阪府', '福岡県'];
        $allowed_genres = ['寿司', '焼肉', 'イタリアン', '居酒屋', 'ラーメン'];
        $allowed_extensions = ['jpg', 'jpeg', 'png'];

        $errors = [];
        $shops = [];

        foreach ($csv as $index => $row) {
            // バリデーション
            $validator = Validator::make($row, [
                '店舗名' => 'required|string|max:50',
                '地域' => ['required', function ($attribute, $value, $fail) use ($allowed_areas) {
                    if (!in_array($value, $allowed_areas)) {
                        $fail('地域は「東京都」「大阪府」「福岡県」のいずれかを指定してください。');
                    }
                }],
                'ジャンル' => ['required', function ($attribute, $value, $fail) use ($allowed_genres) {
                    if (!in_array($value, $allowed_genres)) {
                        $fail('ジャンルは「寿司」「焼肉」「イタリアン」「居酒屋」「ラーメン」のいずれかを指定してください。');
                    }
                }],
                '店舗概要' => 'required|string|max:400',
                '画像URL' => ['required', function ($attribute, $value, $fail) use ($allowed_extensions) {
                    $extension = pathinfo($value, PATHINFO_EXTENSION);
                    if (!in_array(strtolower($extension), $allowed_extensions)) {
                        $fail('画像URLは jpg、jpeg、png のいずれかの形式でアップロードしてください。');
                    }
                }]
            ]);

            // バリデーション失敗時の処理
            if ($validator->fails()) {
                $errors[$index + 1] = $validator->errors()->all();
                continue;
            }

            // 地域とジャンルを取得
            $area = Area::where('name', $row['地域'])->first();
            $genre = Genre::where('name', $row['ジャンル'])->first();

            // 現在の日時を取得
            $now = now();

            // 店舗情報を配列に追加（created_at, updated_atを含める）
            $shops[] = [
                'name' => $row['店舗名'],
                'area_id' => $area->id ?? null,
                'genre_id' => $genre->id ?? null,
                'overview' => $row['店舗概要'],
                'image' => $row['画像URL'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // エラーがある場合はエラーを返す
        if (!empty($errors)) {
            return redirect()->route('import.form')->withErrors($errors);
        }

        // データを保存
        Shop::insert($shops);

        return redirect()->route('import.form')->with('success', 'CSVのインポートが完了しました！');
    }
}
