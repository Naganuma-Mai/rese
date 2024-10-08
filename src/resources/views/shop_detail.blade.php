@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/shop_detail.css') }}">
@endsection

@section('content')
<div class="shop-detail__content">
    <div class="shop-detail__inner">
        <div class="shop-detail__section">
            <div class="shop-detail__header">
                <form class="shop-detail__form" action="/" method="get">
                    @csrf
                    <button class="shop-detail__button"><</button>
                </form>
                <h2 class="shop-detail__ttl">
                    {{ $shop->name }}
                </h2>
            </div>
            <div class="shop-detail__img">
                <img src="{{ asset($shop->image) }}">
            </div>
            <div class="shop-detail__text">
                <div class="shop-detail__tag">
                    <p class="shop-detail__tag-item">#{{ $shop->area->name }}</p>
                    <p class="shop-detail__tag-item shop-detail__tag-last">#{{ $shop->genre->name }}</p>
                </div>
                <p class="shop-detail__text-overview">
                    {{ $shop->overview }}
                </p>
            </div>
        </div>

        <div class="reservation__form">
            <h2 class="reservation__ttl">予約</h2>
            <form class="form" action="/done" method="post">
                @csrf
                <div class="reservation__form-content">
                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                    <div class="form__item">
                        <input id="input_date" class="form__item--input form__item--input-date" type="date" name="date">
                    </div>
                    <div class="form__item">
                        <input id="input_time" class="form__item--input form__item--input-time" type="time" name="time">
                    </div>
                    <div class="form__item">
                        <select id="select_number" class="form__item--select" name="number">
                            <option disabled selected></option>
                            @for($i = 1; $i < 101; $i++)
                                <option value="{{ $i }}" {{ old('number')==$i ? 'selected' : '' }}>{{
                                $i }}人</option>
                            @endfor
                        </select>
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
                                <td id="date" class="reservation-table__text">
                                </td>
                            </tr>
                            <tr class="reservation-table__row">
                                <th class="reservation-table__header">Time</th>
                                <td id="time" class="reservation-table__text">
                                </td>
                            </tr>
                            <tr class="reservation-table__row">
                                <th class="reservation-table__header">Number</th>
                                <td id="number" class="reservation-table__text">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="reservation__alert">
                        @if ($errors->any())
                            <div class="reservation__alert--danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <button class="form__button-submit" type="submit">予約する</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById("input_date").onchange = function() {
        let date = document.getElementById("input_date").value;
        document.getElementById("date").textContent = date;
    }

    document.getElementById("input_time").onchange = function() {
        let time = document.getElementById("input_time").value;
        document.getElementById("time").textContent = time;
    }

    document.getElementById("select_number").onchange = function() {
        let number = document.getElementById("select_number").value;
        document.getElementById("number").textContent = number + "人";
    }
</script>
@endsection
