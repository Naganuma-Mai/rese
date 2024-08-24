@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<div class="review__content">
    <div class="review__inner">
        <div class="review__form">
            <div class="review__form-content">
                <h2 class="review__ttl">レビュー</h2>
                <form class="form" action="/review" method="post">
                    @csrf
                    <div class="review-table">
                        <table class="review-table__inner">
                            <tr class="review-table__row">
                                <th class="review-table__header">Shop</th>
                                <td class="review-table__text">
                                    <input class="form__item--input" type="hidden" name="shop_id" value="{{ $shop->id }}">
                                    {{ $shop->name }}
                                </td>
                            </tr>
                            <tr class="review-table__row">
                                <th class="review-table__header">Point</th>
                                <td class="review-table__text">
                                    <select class="form__item--select" name="point">
                                        <option disabled selected></option>
                                        @for($i = 1; $i < 6; $i++)
                                            <option value="{{ $i }}">{{
                                            $i }}点</option>
                                        @endfor
                                    </select>
                                        <!-- <div class="form__error">
                                            @error('category_id')
                                            {{ $message }}
                                            @enderror
                                        </div> -->
                                </td>
                            </tr>
                            <tr class="review-table__row">
                                <th class="review-table__header">Comment</th>
                                <td class="review-table__text">
                                    <textarea class="form__item--textarea" name="comment" placeholder="コメントをご記載ください">{{ old('comment') }}</textarea>
                                    <!-- <div class="form__error">
                                        @error('gender')
                                        {{ $message }}
                                        @enderror
                                    </div> -->
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- <div class="form__button"> -->
                        <button class="form__button-submit" type="submit">投稿する</button>
                    <!-- </div> -->
                </form>
            </div>
        </div>
    <div>
</div>

@endsection
