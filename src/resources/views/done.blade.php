@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="thanks__content">
    <div class="thanks__heading">
        ご予約ありがとうございます
    </div>
    <div class="back__button">
        <a class="back__button-link" href="/">戻る</a>
    </div>
</div>
@endsection
