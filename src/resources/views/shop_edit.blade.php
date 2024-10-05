@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/shop_edit.css') }}">
@endsection

@section('content')
<div class="edit__content">
    <div class="edit__inner">
        <div class="shop__form">
            <h2 class="shop__ttl">店舗情報更新</h2>
            <form class="form" action="/representative/shops/update" method="post" enctype="multipart/form-data">
                @csrf
                <div class="shop__form-content">
                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                    <div class="shop-table">
                        <table class="shop-table__inner">
                            <tr class="shop-table__row">
                                <th class="shop-table__header">Area</th>
                                <td class="shop-table__text">
                                    <select class="form__item--select" name="area_id">
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}" @if( $shop->area_id==$area->id ) selected @endif>{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr class="shop-table__row">
                                <th class="shop-table__header">Genre</th>
                                <td class="shop-table__text">
                                    <select
                                    class="form__item--select" name="genre_id">
                                        @foreach ($genres as $genre)
                                            <option value="{{ $genre->id }}" @if( $shop->genre_id==$genre->id ) selected @endif>{{ $genre->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr class="shop-table__row">
                                <th class="shop-table__header">Name</th>
                                <td class="shop-table__text">
                                    <input class="form__item--input" type="text" name="name" value="{{ $shop->name }}">
                                </td>
                            </tr>
                            <tr class="shop-table__row">
                                <th class="shop-table__header">Overview</th>
                                <td class="shop-table__text">
                                    <textarea class="form__item--textarea" name="overview">{{ $shop->overview }}</textarea>
                                </td>
                            </tr>
                            <tr class="shop-table__row">
                                <th class="shop-table__header">Image</th>
                                <td class="shop-table__text">
                                    <input class="form__item--input-file" type="file" name="image">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <button class="form__button-submit" type="submit">更新する</button>
            </form>
        </div>
    <div>
</div>

@endsection
