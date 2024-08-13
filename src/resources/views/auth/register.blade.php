@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register__content">
    <div class="register__box">
        <div class="register-form__heading">
            Registration
        </div>
        <form class="form" action="/register" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-content">
                    <img src="{{ asset('images/user.png') }}" class="form__group-img" alt="">
                    <div class="form__input--text">
                        <input type="text" name="name" placeholder="Username" value="{{ old('name') }}">
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
</div>
@endsection
