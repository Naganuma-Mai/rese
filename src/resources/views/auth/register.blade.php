@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register__content">
    <div class="register-form__heading">
        Registration
    </div>
    <form class="form" action="/register" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="name" placeholder="Username" value="{{ old('name') }}">
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="password" placeholder="Password" name="password">
                </div>
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">登録</button>
        </div>
    </form>
    <!-- <div class="login__button">
        <p class="login__message">アカウントをお持ちの方はこちらから</p>
        <a class="login__button-link" href="/login">ログイン</a>
    </div> -->
</div>
@endsection
