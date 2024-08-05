<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        // テーブル・モデル作成後に記述
        //$shops = Shop::all();
        $shops = Shop::with(['area', 'genre'])->get();
        $areas = Area::all();
        $genres = Genre::all();

        $user_id = Auth::id();
        $likes = Like::where('user_id', $user_id)->get();


        return view('my_page', compact('shops', 'areas', 'likes'));
    }
}
