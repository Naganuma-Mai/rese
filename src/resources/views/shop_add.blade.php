@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/shop_add.css') }}">
@endsection

@section('content')
<div class="add__content">
    <div class="add__inner">
        <div class="shop__form">
            <h2 class="shop__ttl">店舗情報作成</h2>
            <form class="form" action="/representative/shops/create" method="post" enctype="multipart/form-data">
                @csrf
                <div class="shop__form-content">
                    <div class="shop-table">
                        <table class="shop-table__inner">
                            <tr class="shop-table__row">
                                <th class="shop-table__header">Area</th>
                                <td class="shop-table__text">
                                    <select class="form__item--select" name="area_id">
                                        <option value="" selected></option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}" @if( request('area_id')==$area->id ) selected @endif>{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr class="shop-table__row">
                                <th class="shop-table__header">Genre</th>
                                <td class="shop-table__text">
                                    <select
                                    class="form__item--select" name="genre_id">
                                        <option value="" selected></option>
                                        @foreach ($genres as $genre)
                                            <option value="{{ $genre->id }}" @if( request('genre_id')==$genre->id ) selected @endif>{{ $genre->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr class="shop-table__row">
                                <th class="shop-table__header">Name</th>
                                <td class="shop-table__text">
                                    <input class="form__item--input" type="text" name="name">
                                    <!-- <div class="form__error">
                                        @error('detail')
                                        {{ $message }}
                                        @enderror
                                    </div> -->
                                </td>
                            </tr>
                            <tr class="shop-table__row">
                                <th class="shop-table__header">Overview</th>
                                <td class="shop-table__text">
                                    <textarea class="form__item--textarea" name="overview"></textarea>
                                    <!-- <div class="form__error">
                                        @error('detail')
                                        {{ $message }}
                                        @enderror
                                    </div> -->
                                </td>
                            </tr>
                            <tr class="shop-table__row">
                                <th class="shop-table__header">Image</th>
                                <td class="shop-table__text">
                                    <input class="form__item--input-file" type="file" name="image">
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
                    <button class="form__button-submit" type="submit">作成する</button>
                <!-- </div> -->
            </form>
        </div>
    <div>
</div>

@endsection
