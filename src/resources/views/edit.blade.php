@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<div class="edit__content">
    <div class="edit__inner">
        <div class="reservation__form">
            <h2 class="reservation__ttl">予約変更</h2>
            <form class="form" action="/edit" method="post">
                @csrf
                <div class="reservation__form-content">
                    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
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
                                <td class="reservation-table__text">
                                    <input class="form__item--input form__item--input-date" type="date" name="date" value="{{ $reservation->date }}">
                                    <!-- <div class="form__error">
                                        @error('gender')
                                        {{ $message }}
                                        @enderror
                                    </div> -->
                                </td>
                            </tr>
                            <tr class="reservation-table__row">
                                <th class="reservation-table__header">Time</th>
                                <td class="reservation-table__text">
                                    <input class="form__item--input form__item--input-time" type="time" name="time" value="{{ $reservation->time }}">
                                    <!-- <div class="form__error">
                                        @error('detail')
                                        {{ $message }}
                                        @enderror
                                    </div> -->
                                </td>
                            </tr>
                            <tr class="reservation-table__row">
                                <th class="reservation-table__header">Number</th>
                                <td class="reservation-table__text">
                                    <select class="form__item--select" name="number">
                                        <option disabled selected></option>
                                        @for($i = 1; $i < 101; $i++)
                                            <option value="{{ $i }}" {{ $reservation->number==$i ? 'selected' : '' }}>{{
                                            $i }}人</option>
                                        @endfor
                                    </select>
                                        <!-- <div class="form__error">
                                            @error('category_id')
                                            {{ $message }}
                                            @enderror
                                        </div> -->
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
                <!-- <div class="form__button"> -->
                    <button class="form__button-submit" type="submit">変更する</button>
                <!-- </div> -->
            </form>
        </div>
    <div>
</div>

@endsection
