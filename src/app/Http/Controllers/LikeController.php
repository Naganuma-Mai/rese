<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Auth;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        $user_id = Auth::id();
        $shop_id = $request->shop_id;
        $already_liked = Like::where('user_id', $user_id)->where('shop_id', $shop_id)->first();

        //ユーザーがこの飲食店をお気に入りにしていない場合、create
        if (!$already_liked) {
            Like::create([
                'user_id' => $user_id,
                'shop_id' => $shop_id
            ]);

            // $request['user_id'] = Auth::id();
            // Reservation::create(
            //     $request->only([
            //         'user_id',
            //         'shop_id'
            //     ])
            // );

        //ユーザーがこの飲食店を既にお気に入りにしていた場合、delete
        } else {
            Like::where('shop_id', $shop_id)->where('user_id', $user_id)->delete();
        }
    }
}
