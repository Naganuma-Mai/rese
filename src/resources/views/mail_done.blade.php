@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/mail_done.css') }}">
@endsection

@section('content')
<div class="done__content">
    <div class="done__box">
        <div class="done__heading">
            お知らせメールを<br class="sp_br">送信しました
        </div>
        <form class="done__form" action="/representative/admin" method="get">
            @csrf
            <div class="done__form-item">
                <button class="done__form-button" type="submit">戻る</button>
            </div>
        </form>
    </div>
</div>
@endsection
