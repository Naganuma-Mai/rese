<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Auth;

class LikeController extends Controller
{
    // public function like(Request $request)
    // {
    //     $user_id = Auth::id();
    //     $shop_id = $request->shop_id;
    //     $already_liked = Like::where('user_id', $user_id)->where('shop_id', $shop_id)->first();

    //     //ユーザーがこの飲食店をお気に入りにしていない場合、create
    //     if (!$already_liked) {
    //         Like::create([
    //             'user_id' => $user_id,
    //             'shop_id' => $shop_id
    //         ]);

    //     //ユーザーがこの飲食店を既にお気に入りにしていた場合、delete
    //     } else {
    //         Like::where('shop_id', $shop_id)->where('user_id', $user_id)->delete();
    //     }
    // }

    public function like(Request $request) {
        $user = Auth::user();
        $shop_id = $request->shop_id;
        // すでにお気に入りにしていればお気に入りから外す
        if ($user->is_like($shop_id)) {
            $user->like_shops()->detach($shop_id);
        // まだお気に入りにしていなければお気に入りにする
        } else {
            $user->like_shops()->attach($shop_id);
        }

        return back();
    }

    // public function store($shop_id) {
    //     $user = Auth::user();
    //     // まだお気に入りにしていなければお気に入りにする
    //     if (!$user->is_like($shop_id)) {
    //         $user->like_shops()->attach($shop_id);
    //     }
    //     return back();
    // }

    // public function destroy($shop_id) {
    //     $user = Auth::user();
    //     // すでにお気に入りにしていればお気に入りから外す
    //     if ($user->is_like($shop_id)) {
    //         $user->like_shops()->detach($shop_id);
    //     }
    //     return back();
    // }
}
