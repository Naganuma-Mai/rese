@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/qr_code.css') }}">
@endsection

@section('content')
<div class="qrcode__content">
    <div class="qrcode_inner">
        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate('https://www.example.com')) !!} ">
    </div>
</div>
@endsection
