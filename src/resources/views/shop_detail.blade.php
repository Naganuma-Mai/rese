@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_detail.css') }}">
@endsection

@section('content')
<div class="shop-detail__content">
    <div class="shop-detail__inner">
        <h2 class="shop-detail-ttl">
            {{ $shop->name }}
        </h2>
        <div class="shop-detail__img">
            <img src="{{ $shop->image }}" alt="">
        </div>
        <div class="shop-detail__text">
            <div class="shop-detail__tag">
                <p class="shop-detail__tag-item">#{{ $shop->area->name }}</p>
                <p class="shop-detail__tag-item">#{{ $shop->genre->name }}</p>
                </p>
            </div>
            <p class="shop-detail__text-overview">
                {{ $shop->overview }}
            </p>
        </div>
    </div>

    <div class="reservation__content">
        <h2 class="reservation__heading">予約</h2>

        <form class="form" action="/done" method="post">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            <div class="form__item">
                <input class="form__item--input" type="date" name="date">
                <!-- <div class="form__error">
                    @error('gender')
                    {{ $message }}
                    @enderror
                </div> -->
            </div>

            <div class="form__item">
                <input class="form__item--input" type="time" name="time">
                <!-- <div class="form__error">
                    @error('detail')
                    {{ $message }}
                    @enderror
                </div> -->
            </div>

            <div class="form__item">
                <select class="form__item--select" name="number">
                    <option value="1" selected>1人</option>
                    @for($i = 2; $i < 10; $i++)
                        <option value="{{ $i }}" {{ old('number')==$i ? 'selected' : '' }}>{{
                        $i }}人</option>
                    @endfor
                </select>
                    <!-- <div class="form__error">
                        @error('category_id')
                        {{ $message }}
                        @enderror
                    </div> -->
            </div>

            <div class="reservation-table">
                <table class="reservation-table__inner">
                    <tr class="reservation-table__row">
                        <th class="reservation-table__header">Shop</th>
                        <td class="reservation-table__text">
                            {{ $shop->name }}
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

            <div class="form__button">
                <button class="form__button-submit" type="submit">予約する</button>
            </div>
        </form>
    </div>
</div>
@endsection
