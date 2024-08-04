@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_all.css') }}">
@endsection

@section('form')
<form class="search-form" action="/shops/search" method="get">
    @csrf
    <div class="search-form__item">
        <select class="search-form__item-select" name="area_id">
            <option value="" selected>All area</option>
            @foreach ($areas as $area)
                <option value="{{ $area->id }}">{{ $area->name }}</option>
            @endforeach
        </select>
        <select class="search-form__item-select" name="genre_id">
            <option value="" selected>All genre</option>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
        </select>
        <input class="search-form__item-input" type="text" name="keyword" placeholder="Search ..." value="{{ old('keyword') }}">
        <button class="search-form__button-submit" type="submit">検索</button>
    </div>
</form>
@endsection

@section('content')
<div class="shop-all__content">
    <div class="shop-all_inner">
        @foreach ($shops as $shop)
        <div class="card">
            <div class="card__img">
                <img src="{{ $shop->image }}" alt="">
            </div>
            <div class="card__content">
                <div class="card__content-cat">カテゴリー</div>
                <h2 class="card__content-ttl">
                    {{ $shop->name }}
                </h2>
                <div class="card__content-tag">
                    <p class="card__content-tag-item">#{{ $shop->area->name }}</p>
                    <p class="card__content-tag-item">#{{ $shop->genre->name }}</p>
                    </p>
                </div>
                <form class="card__content-form" action="/detail/:shop_id" method="get">
                    @csrf
                    <div class="form__item">
                        <!-- <input type="hidden" name="shop_id" value="{{ $shop->id }}"> -->
                        <button class="card__content-button" type="submit">詳しくみる</button>
                    </div>
                </form>
                <i class="far fa-heart"></i>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
