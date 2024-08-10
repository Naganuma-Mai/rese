@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="my-page__content">
    <div class="my-page__heading">
        {{ Auth::user()->name }}さん
    </div>
    <div class="my-page_inner">
        <div class="reservation__content">
            <h2 class="reservation__heading">予約状況</h2>
            @foreach ($reservations as $reservation)
            <div class="reservation-card">
                <p class="reservation-card__title">
                    予約{{ $loop->iteration }}
                </p>
                <div class="reservation-card__table">
                    <table class="reservation-card__table-inner">
                        <tr class="reservation-card__table-row">
                            <th class="reservation-card__table-header">Shop</th>
                            <td class="reservation-card__table-text">
                                {{ $reservation->shop->name }}
                            </td>
                        </tr>
                        <tr class="reservation-card__table-row">
                            <th class="reservation-card__table-header">Date</th>
                            <td class="reservation-card__table-text">{{ $reservation->date }}
                            </td>
                        </tr>
                        <tr class="reservation-card__table-row">
                            <th class="reservation-card__table-header">Time</th>
                            <td class="reservation-card__table-text">{{ $reservation->time }}
                            </td>
                        </tr>
                        <tr class="reservation-card__table-row">
                            <th class="reservation-card__table-header">Number</th>
                            <td class="reservation-card__table-text">{{ $reservation->number }}人
                            </td>
                        </tr>
                    </table>
                </div>
                <form action="/delete" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $reservation->id }}">
                    <button class="reservation-card__form-button" type="submit">×</button>
                </form>
            </div>
            @endforeach
        </div>

        <div class="favorite-shops__content">
            <h2 class="favorite-shops__heading">お気に入り店舗</h2>
            @foreach ($like_shops as $shop)
            <div class="shop-card">
                <div class="shop-card__img">
                    <img src="{{ $shop->image }}" alt="">
                </div>
                <div class="shop-card__content">
                    <div class="shop-card__content-cat">カテゴリー</div>
                    <h2 class="shop-card__content-ttl">
                        {{ $shop->name }}
                    </h2>
                    <div class="shop-card__content-tag">
                        <p class="shop-card__content-tag-item">#{{ $shop->area->name }}</p>
                        <p class="shop-card__content-tag-item">#{{ $shop->genre->name }}</p>
                        </p>
                    </div>
                    <form class="shop-card__content-form" action="/detail/:shop_id" method="get">
                        @csrf
                        <!-- <div class="form__item"> -->
                            <!-- <input type="hidden" name="shop_id" value="{{ $shop->id }}"> -->
                            <button class="shop-card__content-button" type="submit">詳しくみる</button>
                        <!-- </div> -->
                    </form>
                    <!-- お気に入りにしていないお店 -->
                    @if (!Auth::user()->is_like($shop->id))
                        <span class="likes">
                            <i class="fa-solid fa-heart like-toggle" data-shop-id="{{ $shop->id }}"></i>
                            <!-- <i class="fas like-toggle" data-shop-id="{{ $shop->id }}"></i> -->
                        </span><!-- /.likes -->
                    <!-- 既にお気に入りにしているお店 -->
                    @else
                        <span class="likes">
                            <i class="fa-solid fa-heart like-toggle  liked" data-shop-id="{{ $shop->id }}"></i>
                            <!-- <i class="fas heart like-toggle liked" data-shop-id="{{ $shop->id }}"></i> -->
                        </span><!-- /.likes -->
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    $(function () {
        let like = $('.like-toggle'); //like-toggleのついたiタグを取得し代入。
        let like_shop_id; //変数を宣言（なんでここで？）
        like.on('click', function () { //onはイベントハンドラー
            let $this = $(this); //this=イベントの発火した要素＝iタグを代入
            like_shop_id = $this.data('shop-id'); //iタグに仕込んだdata-shop-idの値を取得
            //ajax処理スタート
            $.ajax({
                headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
                url: '/like', //通信先アドレスで、このURLをあとでルートで設定します
                method: 'POST', //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
                data: { //サーバーに送信するデータ
                    'shop_id': like_shop_id //お気に入りにしたお店のidを送る
                },
            })
            //通信成功した時の処理
            .done(function (data) {
                $this.toggleClass('liked'); //likedクラスのON/OFF切り替え。
            })
            //通信失敗した時の処理
            .fail(function () {
                console.log('fail');
            });
        });
    });
</script>
@endsection
