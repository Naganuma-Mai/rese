@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="thanks__content">
    <div class="thanks__box">
        <div class="thanks__heading">
            ご予約<br class="sp_br">ありがとうございます
        </div>
        <form class="thanks__form" action="/detail/{{ $shop_id }}" method="get">
            @csrf
            <div class="thanks__form-item">
                <button class="thanks__form-button" type="submit">戻る</button>
            </div>
        </form>
    </div>
</div>
@endsection
