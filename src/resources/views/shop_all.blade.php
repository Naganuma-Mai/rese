@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/shop_all.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
@endsection

@section('form')
<form class="search-form" action="/shops/search" method="get">
    @csrf
    <div class="search-form__item">
        <select onchange="submit(this.form)" class="search-form__item-select" name="area_id">
            <option value="" selected>All area</option>
            @foreach ($areas as $area)
                <option value="{{ $area->id }}" @if( request('area_id')==$area->id ) selected @endif>
                    {{ $area->name }}
                </option>
            @endforeach
        </select>
        <select onchange="submit(this.form)" class="search-form__item-select" name="genre_id">
            <option value="" selected>All genre</option>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" @if( request('genre_id')==$genre->id ) selected @endif>
                    {{ $genre->name }}
                </option>
            @endforeach
        </select>
        <img src="{{ asset('images/search.png') }}" class="search-form__item-img" alt="">
        <input class="search-form__item-input" type="text" name="keyword" placeholder="Search ..." value="{{request('keyword')}}">
    </div>
</form>
@endsection

@section('content')
<div class="shop-all__content">
    <div class="shop-all_inner">
        @foreach ($shops as $shop)
        <div class="card">
            <div class="card__img">
                <img src="{{ asset($shop->image) }}">
            </div>
            <div class="card__content">
                <h2 class="card__content-ttl">
                    {{ $shop->name }}
                </h2>
                <div class="card__content-tag">
                    <p class="card__content-tag-item">#{{ $shop->area->name }}</p>
                    <p class="card__content-tag-item">#{{ $shop->genre->name }}</p>
                </div>
                <div class="card__content-footer">
                    <form class="card__content-form" action="/detail/{{ $shop->id }}" method="get">
                        @csrf
                        <div class="form__item">
                            <button class="card__content-button" type="submit">詳しくみる</button>
                        </div>
                    </form>
                    <!-- ログイン後 -->
                    @if (Auth::check())
                        <!-- お気に入りにしていないお店 -->
                        @if (!Auth::user()->isLike($shop->id))
                            <a class="toggle_like" shop_id="{{ $shop->id }}" like_val="0">
                                <img src="{{ asset('images/heart_gray.png') }}" class="card__content-img" alt="">
                            </a>
                        <!-- 既にお気に入りにしているお店 -->
                        @else
                            <a class="toggle_like" shop_id="{{ $shop->id }}" like_val="1">
                                <img src="{{ asset('images/heart_red.png') }}" class="card__content-img" alt="">
                            </a>
                        @endif
                    <!-- ログイン前 -->
                    @else
                        <a class="likes">
                            <img src="{{ asset('images/heart_gray.png') }}" class="card__content-img" alt="">
                        </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script src="{{ asset('js/like.js') }}"></script>
@endsection
