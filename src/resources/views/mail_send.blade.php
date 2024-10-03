@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/mail_send.css') }}">
@endsection

@section('content')
<div class="mail__content">
    <div class="mail__inner">
        <div class="mail__form">
            <h2 class="mail__ttl">お知らせメール送信</h2>
            <form class="form" action="/representative/mail" method="post">
                @csrf
                <div class="mail__form-content">
                    <div class="mail-table">
                        <table class="mail-table__inner">
                            <tr class="mail-table__row">
                                <th class="mail-table__header">件名</th>
                                <td class="mail-table__text">
                                    <input class="form__item--input" type="text" name="subject">
                                    <!-- <div class="form__error">
                                        @error('detail')
                                        {{ $message }}
                                        @enderror
                                    </div> -->
                                </td>
                            </tr>
                            <tr class="mail-table__row">
                                <th class="mail-table__header">本文</th>
                                <td class="mail-table__text">
                                    <textarea class="form__item--textarea" name="content"></textarea>
                                    <!-- <div class="form__error">
                                        @error('detail')
                                        {{ $message }}
                                        @enderror
                                    </div> -->
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- <div class="reservation__alert">
                        @if ($errors->any())
                            <div class="reservation__alert--danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div> -->
                </div>
                <!-- <div class="form__button"> -->
                    <button class="form__button-submit" type="submit">送信する</button>
                <!-- </div> -->
            </form>
        </div>
    <div>
</div>

@endsection
