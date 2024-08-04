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
        <div class="reservation__status">
            <h2>予約状況</h2>
            $reservation_count = 1;
            @foreach ($reservations as $reservation)
            <div class="card">
                <p class="card__title">
                    予約{{ $reservation_count }}
                </p>
                <div class="reservation-table">
                    <table class="reservation-table__inner">
                        <tr class="reservation-table__row">
                            <th class="reservation-table__header">Shop</th>
                            <td class="reservation-table__text">
                                {{ $reservation->shop->name }}
                            </td>
                        </tr>
                        <tr class="reservation-table__row">
                            <th class="reservation-table__header">Date</th>
                            <td class="reservation-table__text">{{ $reservation->date }}
                            </td>
                        </tr>
                        <tr class="reservation-table__row">
                            <th class="reservation-table__header">Time</th>
                            <td class="reservation-table__text">{{ $reservation->time }}
                            </td>
                        </tr>
                        <tr class="reservation-table__row">
                            <th class="reservation-table__header">Number</th>
                            <td class="reservation-table__text">{{ $reservation->number }}人
                            </td>
                        </tr>
                    </table>
                </div>
                <form action="/delete" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $reservation->id }}">
                    <button class="reservation__form-button" type="submit">×</button>
                </form>
            </div>
            $reservation_count = $reservation_count + 1;
            @endforeach
        </div>

        <div class="favorite__shops">
            <h2>お気に入り店舗</h2>
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
</div>
@endsection
