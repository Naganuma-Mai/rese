@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__content">
    <div class="thanks__heading">
        会員登録ありがとうございます
    </div>
    <div class="login__button">
        <a class="login__button-link" href="/login">ログインする</a>
    </div>
</div>
@endsection
