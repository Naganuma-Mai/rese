<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Auth;

class LikeController extends Controller
{
    public function store(Request $request) {
        $user = Auth::user();
        $shop_id = $request->shop_id;
        // まだお気に入りにしていなければお気に入りにする
        if (!$user->is_like($shop_id)) {
            $user->like_shops()->attach($shop_id);
        }
        return back();
    }

    public function destroy(Request $request) {
        $user = Auth::user();
        $shop_id = $request->shop_id;
        // すでにお気に入りにしていればお気に入りから外す
        if ($user->is_like($shop_id)) {
            $user->like_shops()->detach($shop_id);
        }
        return back();
    }
}
