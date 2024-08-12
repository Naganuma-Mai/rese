@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
@endsection

@section('content')
<div class="my-page__content">
    <div class="my-page__heading">
        {{ Auth::user()->name }}さん
    </div>
    <div class="my-page_inner">
        <div class="reservation__content">
            <h2 class="reservation__heading">予約状況</h2>
            @foreach ($reservations as $reservation)
            <div class="reservation-card">
                <img src="{{ asset('images/clock.png') }}" alt="">
                <p class="reservation-card__title">
                    予約{{ $loop->iteration }}
                </p>
                <div class="reservation-card__table">
                    <table class="reservation-card__table-inner">
                        <tr class="reservation-card__table-row">
                            <th class="reservation-card__table-header">Shop</th>
                            <td class="reservation-card__table-text">
                                {{ $reservation->shop->name }}
                            </td>
                        </tr>
                        <tr class="reservation-card__table-row">
                            <th class="reservation-card__table-header">Date</th>
                            <td class="reservation-card__table-text">{{ $reservation->date }}
                            </td>
                        </tr>
                        <tr class="reservation-card__table-row">
                            <th class="reservation-card__table-header">Time</th>
                            <td class="reservation-card__table-text">
                                {{ substr($reservation->time, 0, 5) }}
                            </td>
                        </tr>
                        <tr class="reservation-card__table-row">
                            <th class="reservation-card__table-header">Number</th>
                            <td class="reservation-card__table-text">{{ $reservation->number }}人
                            </td>
                        </tr>
                    </table>
                </div>
                <form action="/delete" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $reservation->id }}">
                    <button class="reservation-card__form-button" type="submit">×</button>
                </form>
            </div>
            @endforeach
        </div>

        <div class="favorite-shops__content">
            <h2 class="favorite-shops__heading">お気に入り店舗</h2>
            @foreach ($like_shops as $shop)
            <div class="shop-card">
                <div class="shop-card__img">
                    <img src="{{ $shop->image }}" alt="">
                </div>
                <div class="shop-card__content">
                    <div class="shop-card__content-cat">カテゴリー</div>
                    <h2 class="shop-card__content-ttl">
                        {{ $shop->name }}
                    </h2>
                    <div class="shop-card__content-tag">
                        <p class="shop-card__content-tag-item">#{{ $shop->area->name }}</p>
                        <p class="shop-card__content-tag-item">#{{ $shop->genre->name }}</p>
                        </p>
                    </div>
                    <form class="shop-card__content-form" action="/detail/:shop_id" method="get">
                        @csrf
                        <!-- <div class="form__item"> -->
                            <!-- <input type="hidden" name="shop_id" value="{{ $shop->id }}"> -->
                            <button class="shop-card__content-button" type="submit">詳しくみる</button>
                        <!-- </div> -->
                    </form>
                    <!-- お気に入りにしていないお店 -->
                    @if (!Auth::user()->is_like($shop->id))
                        <a class="toggle_like" shop_id="{{ $shop->id }}" like_val="0">
                            <img src="{{ asset('images/heart_gray.png') }}" class="icon_like" alt="">
                        </a>
                    <!-- 既にお気に入りにしているお店 -->
                    @else
                        <a class="toggle_like" shop_id="{{ $shop->id }}" like_val="1">
                            <img src="{{ asset('images/heart_red.png') }}" class="icon_like" alt="">
                        </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script src="{{ asset('js/like.js') }}"></script>
@endsection
