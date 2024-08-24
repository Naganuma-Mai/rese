<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Review;
use Illuminate\Http\Request;
use Auth;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $shop = Shop::find($request->shop_id);

        return view('review', compact('shop'));
    }

    public function store(Request $request)
    {
        $request['user_id'] = Auth::id();
        Review::create(
            $request->only([
                'user_id',
                'shop_id',
                'point',
                'comment'
            ])
        );

        return view('review_done');
    }
}
