@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
@endsection

@section('content')
<div class="my-page__content">
    <h1 class="my-page__heading">
        {{ Auth::user()->name }}さん
    </h1>
    <div class="my-page_inner">
        <div class="reservation__content">
            <h2 class="reservation__heading">予約状況</h2>
            @foreach ($reservations as $reservation)
            <div class="reservation-card">
                <div class="reservation-card__header">
                    <img src="{{ asset('images/clock.png') }}" class="reservation-card__img" alt="">
                    <p class="reservation-card__title">
                        予約{{ $loop->iteration }}
                    </p>
                    <form class="reservation-card__form-delete" action="/delete" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $reservation->id }}">
                        <button class="reservation-card__button-delete" type="submit">×</button>
                    </form>
                </div>
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
                <div class="reservation-card__form">
                    <form class="reservation-card__form--stripe" action="{{ asset('pay') }}" method="POST">
                        {{ csrf_field() }}
                        <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="{{ env('STRIPE_KEY') }}"
                        data-amount="1000"
                        data-name="Stripe Demo"
                        data-label="決済"
                        data-description="これはStripeのデモです"
                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                        data-locale="auto"
                        data-currency="JPY">
                        </script>
                    </form>
                    <!-- 来店後 -->
                    @if ($reservation->isVisit())
                        <form class="reservation-card__form--review" action="/review" method="get">
                            @csrf
                            <input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">
                            <button class="reservation-card__button" type="submit">レビュー</button>
                        </form>
                    <!-- 来店前 -->
                    @else
                        <form class="reservation-card__form--edit" action="/edit" method="get">
                            @csrf
                            <input type="hidden" name="id" value="{{ $reservation->id }}">
                            <button class="reservation-card__button" type="submit">編集</button>
                        </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <div class="favorite-shops__content">
            <h2 class="favorite-shops__heading">お気に入り店舗</h2>
            <div class="shop-card__group">
                @foreach ($like_shops as $shop)
                <div class="shop-card">
                    <div class="shop-card__img">
                        <img src="{{ $shop->image }}" alt="">
                    </div>
                    <div class="shop-card__content">
                        <h2 class="shop-card__content-ttl">
                            {{ $shop->name }}
                        </h2>
                        <div class="shop-card__content-tag">
                            <p class="shop-card__content-tag-item">#{{ $shop->area->name }}</p>
                            <p class="shop-card__content-tag-item">#{{ $shop->genre->name }}</p>
                            </p>
                        </div>
                        <div class="shop-card__content-footer">
                            <form class="shop-card__content-form" action="/detail/{{ $shop->id }}" method="get">
                                @csrf
                                <!-- <div class="form__item"> -->
                                    <!-- <input type="hidden" name="shop_id" value="{{ $shop->id }}"> -->
                                    <button class="shop-card__content-button" type="submit">詳しくみる</button>
                                <!-- </div> -->
                            </form>
                            <!-- お気に入りにしていないお店 -->
                            @if (!Auth::user()->isLike($shop->id))
                                <a class="toggle_like" shop_id="{{ $shop->id }}" like_val="0">
                                    <img src="{{ asset('images/heart_gray.png') }}" class="shop-card__content-img" alt="">
                                </a>
                            <!-- 既にお気に入りにしているお店 -->
                            @else
                                <a class="toggle_like" shop_id="{{ $shop->id }}" like_val="1">
                                    <img src="{{ asset('images/heart_red.png') }}" class="shop-card__content-img" alt="">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/like.js') }}"></script>
@endsection
