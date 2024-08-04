@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
@endsection

@section('content')
<div class="my-page__content">
    <div class="my-page__heading">
        {{ Auth::user()->name }}さん
    </div>
    <div class="my-page_inner">
        <div class="reservation__content">
            <h2 class="reservation__heading">予約状況</h2>
            $reservation_count = 1;
            @foreach ($reservations as $reservation)
            <div class="reservation-card">
                <p class="reservation-card__title">
                    予約{{ $reservation_count }}
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
                            <td class="reservation-card__table-text">{{ $reservation->time }}
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
            $reservation_count = $reservation_count + 1;
            @endforeach
        </div>

        <div class="favorite-shops__content">
            <h2 class="favorite-shops__heading">お気に入り店舗</h2>
            @foreach ($shops as $shop)
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
                    <i class="far fa-heart"></i>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
