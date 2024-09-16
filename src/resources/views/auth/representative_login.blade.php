@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__content">
    <div class="login__box">
        <div class="login-form__heading">
            店舗代表者ログイン
        </div>
        <form class="form" action="/representative/login" method="post">
            @csrf
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
                        <input type="password" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection
