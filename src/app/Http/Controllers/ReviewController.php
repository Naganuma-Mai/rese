<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Review;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    public function add($shop_id)
    {
        $shop = Shop::find($shop_id);

        return view('review', compact('shop'));
    }

    public function edit($shop_id)
    {
        $shop = Shop::find($shop_id);
        $review = Review::where('user_id', Auth::id())->where('shop_id', $shop_id)->first();

        return view('review', compact('shop', 'review'));
    }

    // 新規作成と更新兼用
    public function store(ReviewRequest $request)
    {
        $review = [
            'user_id' => Auth::id(),
            'shop_id' => $request->shop_id,
            'star' => $request->star,
            'comment' => $request->comment
        ];

        // ファイルがアップロードされている場合
        if ($request->hasFile('image')) {
            // アップロードされたファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();
            // 取得したファイル名で保存
            $request->file('image')->storeAs('public/images' , $file_name);

            $review['image'] = 'storage/images/' . $file_name;
        }

        // review_idキーが存在し、かつ値が入力されている場合
        if ($request->filled('review_id')) {
            Review::find($request->review_id)->update($review);
        // review_idキーが存在しない、もしくはNULLの場合
        } else {
            Review::create($review);
        }

        return redirect("/detail/" . $request->shop_id);
    }

    public function destroyForUser($shop_id)
    {
        Review::where('user_id', Auth::id())->where('shop_id', $shop_id)->delete();
        $shop = Shop::find($shop_id);

        return view('shop_detail', compact('shop'));
    }

    public function destroyForAdmin(Request $request)
    {
        Review::find($request->review_id)->delete();
        $shop = Shop::find($request->shop_id);

        return view('shop_detail', compact('shop'));
    }
}
