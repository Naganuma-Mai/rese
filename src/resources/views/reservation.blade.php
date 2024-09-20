@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/reservation.css') }}">
@endsection

@section('content')
<div class="reservation__content">
    <div class="reservation-header">
        <h1 class="reservation-heading">
            {{ Auth::guard('representative')->user()->shop->name }}予約情報
        </h1>
        <div class="reservation-form">
            <form action="/representative/admin" method="get">
                @csrf
                <button class="reservation__form--button" type="submit">戻る</button>
            </form>
        </div>
    </div>

    <div class="reservation-table">
        <table class="reservation-table__inner">
            <tr class="reservation-table__row">
                <th class="reservation-table__header">Name</th>
                <th class="reservation-table__header">Date</th>
                <th class="reservation-table__header">Time</th>
                <th class="reservation-table__header">Number</th>
            </tr>
            @foreach ($reservations as $reservation)
            <tr class="reservation-table__row">
                <td class="reservation-table__text">
                    {{ $reservation->user->name }}
                </td>
                <td class="reservation-table__text">
                    {{ $reservation->date }}
                </td>
                <td class="reservation-table__text">
                    {{ substr($reservation->time, 0, 5) }}
                </td>
                <td class="reservation-table__text">
                    {{ $reservation->number }}人
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
