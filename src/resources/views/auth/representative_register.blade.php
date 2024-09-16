@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register__content">
    <div class="register__box">
        <div class="register-form__heading">
            店舗代表者登録
        </div>
        <form class="form" action="/admin/representative/register" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-content">
                    <img src="{{ asset('images/user.png') }}" class="form__group-img" alt="">
                    <div class="form__input--text">
                        <input type="text" name="name" placeholder="Representativename" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-content">
                    <img src="{{ asset('images/email.png') }}" class="form__group-img" alt="">
                    <div class="form__input--text">
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-content">
                    <img src="{{ asset('images/password.png') }}" class="form__group-img" alt="">
                    <div class="form__input--text">
                        <input type="password" name="password" placeholder="Password" >
                    </div>
                </div>
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">登録</button>
            </div>
        </form>
    </div>
    <!-- あとで削除 -->
    <form class="header-nav__form" action="/admin/logout" method="post">
        @csrf
        <button class="header-nav__button">管理者ログアウト</button>
    </form>
</div>
@endsection
