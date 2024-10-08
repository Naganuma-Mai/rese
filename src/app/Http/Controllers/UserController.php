<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ユーザーの予約の一覧を取得
        $reservations = $user->reservations;

        // ユーザーがお気に入りにした飲食店の一覧を取得
        $like_shops = $user->likeShops()->get();

        return view('my_page', compact('reservations', 'like_shops'));
    }
}
