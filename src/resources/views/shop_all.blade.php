@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_all.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('form')
<form class="search-form" action="/shops/search" method="get">
    @csrf
    <div class="search-form__item">
        <select class="search-form__item-select" name="area_id">
            <option value="" selected>All area</option>
            @foreach ($areas as $area)
                <option value="{{ $area->id }}">{{ $area->name }}</option>
            @endforeach
        </select>
        <select class="search-form__item-select" name="genre_id">
            <option value="" selected>All genre</option>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
        </select>
        <input class="search-form__item-input" type="text" name="keyword" placeholder="Search ..." value="{{ old('keyword') }}">
        <button class="search-form__button-submit" type="submit">検索</button>
    </div>
</form>
@endsection

@section('content')
<div class="shop-all__content">
    <div class="shop-all_inner">
        @foreach ($shops as $shop)
        <div class="card">
            <div class="card__img">
                <img src="{{ $shop->image }}" alt="">
            </div>
            <div class="card__content">
                <h2 class="card__content-ttl">
                    {{ $shop->name }}
                </h2>
                <div class="card__content-tag">
                    <p class="card__content-tag-item">#{{ $shop->area->name }}</p>
                    <p class="card__content-tag-item">#{{ $shop->genre->name }}</p>
                    </p>
                </div>
                <form class="card__content-form" action="/detail/:shop_id" method="get">
                    @csrf
                    <div class="form__item">
                        <!-- <input type="hidden" name="shop_id" value="{{ $shop->id }}"> -->
                        <button class="card__content-button" type="submit">詳しくみる</button>
                    </div>
                </form>
                <!-- ログイン後 -->
                @if (Auth::check())
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
                <!-- ログイン前 -->
                @else
                    <span class="likes">
                        <i class="fa-solid fa-heart"></i>
                    </span>
                @endif
            </div>
        </div>
        @endforeach
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
