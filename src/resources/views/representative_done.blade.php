@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/representative_done.css') }}">
@endsection

@section('content')
<div class="done__content">
    <div class="done__box">
        <div class="done__heading">
            店舗代表者を登録しました
        </div>
        <form class="done__form" action="/admin/representative/register" method="get">
            @csrf
            <div class="done__form-item">
                <button class="done__form-button" type="submit">戻る</button>
            </div>
        </form>
    </div>
</div>
@endsection
