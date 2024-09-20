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
        //$shops = Shop::all();
        $shops = Shop::with(['area', 'genre'])->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('shop_all', compact('shops', 'areas', 'genres'));
    }

    public function search(Request $request)
    {
        $shops = Shop::with(['area', 'genre'])->AreaSearch($request->area_id)->GenreSearch($request->genre_id)->KeywordSearch($request->keyword)->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('shop_all', compact('shops', 'areas', 'genres'));
    }

    public function detail($shop_id)
    {
        $shop = Shop::find($shop_id);
        // $shops = Shop::with(['area', 'genre'])->get();

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
        $request['representative_id'] = Auth::guard('representative')->id();

        Shop::create(
            $request->only([
                'area_id',
                'genre_id',
                'representative_id',
                'name',
                'overview',
                'image'
            ])
        );

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
        $shop = $request->only(['area_id', 'genre_id', 'name', 'overview', 'image']);
        Shop::find($request->shop_id)->update($shop);

        $message = "店舗情報を更新しました";

        return view('shop_done', compact('message'));
    }
}
