<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::with(['area', 'genre'])->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('shop_all', compact('shops', 'areas', 'genres'));
    }

    public function search(Request $request)
    {
        $shops = Shop::with(['area', 'genre'])->AreaSearch($request->area_id)->GenreSearch($request->genre_id)->KeywordSearch($request->keyword);

        if ($request->sort === 'descending') {
            // 評価が高い順（NULLは最後）
            $shops->leftJoin('reviews', 'shops.id', '=', 'reviews.shop_id')
                ->selectRaw('shops.*, COALESCE(AVG(reviews.star), NULL) as average_rating')
                ->groupBy('shops.id')
                ->orderByRaw('average_rating IS NULL ASC, average_rating DESC');
        } elseif ($request->sort === 'ascending') {
            // 評価が低い順（NULLは最後）
            $shops->leftJoin('reviews', 'shops.id', '=', 'reviews.shop_id')
                ->selectRaw('shops.*, COALESCE(AVG(reviews.star), NULL) as average_rating')
                ->groupBy('shops.id')
                ->orderByRaw('average_rating IS NULL ASC, average_rating ASC');
        } else {
            // ランダム並び替え
            $shops->inRandomOrder();
        }

        $shops = $shops->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('shop_all', compact('shops', 'areas', 'genres'));
    }

    public function detail($shop_id)
    {
        $shop = Shop::find($shop_id);

        return view('shop_detail', compact('shop'));
    }

    public function add()
    {
        $areas = Area::all();
        $genres = Genre::all();

        return view('shop_add', compact('areas', 'genres'));
    }

    public function store(Request $request)
    {
        // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();

        // 取得したファイル名で保存
        $request->file('image')->storeAs('public/images' , $file_name);

        $shop = [
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'representative_id' => Auth::guard('representative')->id(),
            'name' => $request->name,
            'overview' => $request->overview,
            'image' => 'storage/images/' . $file_name,
        ];
        Shop::create($shop);

        $message = "店舗情報を作成しました";

        return view('shop_done', compact('message'));
    }

    public function edit(Request $request)
    {
        $shop = Shop::find($request->shop_id);
        $areas = Area::all();
        $genres = Genre::all();

        return view('shop_edit', compact('shop', 'areas', 'genres'));
    }

    public function update(Request $request)
    {
        // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();

        // 取得したファイル名で保存
        $request->file('image')->storeAs('public/images' , $file_name);

        $shop = [
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'name' => $request->name,
            'overview' => $request->overview,
            'image' => 'storage/images/' . $file_name,
        ];

        Shop::find($request->shop_id)->update($shop);

        $message = "店舗情報を更新しました";

        return view('shop_done', compact('message'));
    }
}
