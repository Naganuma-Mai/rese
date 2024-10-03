@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/representative_admin.css') }}">
@endsection

@section('content')
<div class="admin__content">
    <div class="admin-header">
        <h1 class="admin__heading">
            {{ Auth::guard('representative')->user()->name }}さん
        </h1>
        <div class="mail-form">
            <form action="/representative/mail" method="get">
                @csrf
                <button class="mail__form--button" type="submit">メール送信</button>
            </form>
        </div>
        <form class="logout__form" action="/representative/logout" method="post">
            @csrf
            <button class="logout__button">店舗代表者ログアウト</button>
        </form>
    </div>
    <div class="admin__inner">
        <div class="shop__content">
            <h2 class="shop__heading">店舗情報</h2>
            <div class="shop__form">
                <!-- 店舗情報がない場合 -->
                @if (Auth::guard('representative')->user()->shop == null)
                    <form class="shop__form--add" action="/representative/shops/create" method="get">
                        @csrf
                        <button class="shop__form--button" type="submit">作成</button>
                    </form>
                <!-- 店舗情報がすでにある場合 -->
                @else
                    <form class="shop__form--edit" action="/representative/shops/update" method="get">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ Auth::guard('representative')->user()->shop->id }}">
                        <button class="shop__form--button" type="submit">更新</button>
                    </form>
                @endif
            </div>
        </div>

        <div class="reservation__content">
            <h2 class="reservation__heading">予約情報</h2>
            <!-- 店舗情報がすでにある場合 -->
            @if (Auth::guard('representative')->user()->shop != null)
                <form class="reservation__form" action="/representative/reservation" method="get">
                    @csrf
                    <input type="hidden" name="shop_id" value="{{ Auth::guard('representative')->user()->shop->id }}">
                    <button class="reservation__form--button" type="submit">確認</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
