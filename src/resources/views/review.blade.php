@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
<script
src="https://code.jquery.com/jquery-3.7.1.min.js"
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
crossorigin="anonymous"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="review__content">
    <div class="review__inner">
        <div class="shop__content">
            <h1 class="review__ttl-message">今回のご利用はいかがでしたか？</h1>
            <div class="card">
                <div class="card__img">
                    <img src="{{ asset($shop->image) }}">
                </div>
                <div class="card__content">
                    <h2 class="card__content-ttl">
                        {{ $shop->name }}
                    </h2>
                    <div class="card__content-tag">
                        <p class="card__content-tag-item">#{{ $shop->area->name }}</p>
                        <p class="card__content-tag-item">#{{ $shop->genre->name }}</p>
                    </div>
                    <div class="card__content-footer">
                        <form class="card__content-form" action="/detail/{{ $shop->id }}" method="get">
                            @csrf
                            <div class="form__item">
                                <button class="card__content-button" type="submit">詳しくみる</button>
                            </div>
                        </form>
                        <!-- ログイン後 -->
                        @if (Auth::check())
                            <!-- お気に入りにしていないお店 -->
                            @if (!Auth::user()->isLike($shop->id))
                                <a class="toggle_like" shop_id="{{ $shop->id }}" like_val="0">
                                    <img src="{{ asset('images/heart_gray.png') }}" class="card__content-img" alt="">
                                </a>
                            <!-- 既にお気に入りにしているお店 -->
                            @else
                                <a class="toggle_like" shop_id="{{ $shop->id }}" like_val="1">
                                    <img src="{{ asset('images/heart_red.png') }}" class="card__content-img" alt="">
                                </a>
                            @endif
                        <!-- ログイン前 -->
                        @else
                            <a class="likes">
                                <img src="{{ asset('images/heart_gray.png') }}" class="card__content-img" alt="">
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="review__form">
            <form id="reviewForm" class="form" action="/reviews/store/{{ $shop->id }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="review_id" value="{{ $review->id ?? '' }}">
                <div class="review__form-item">
                    <h2 class="review__form-ttl">体験を評価してください</h2>
                    <div class="form__error">
                        @error('star')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="review__form-rating">
                        <input class="form-rating__input" id="star5" name="star" type="radio" value=5 {{ old('star', $review->star ?? '') == 5 ? 'checked' : '' }}>
                        <label class="form-rating__label" for="star5">★</label>
                        <input class="form-rating__input" id="star4" name="star" type="radio" value=4 {{ old('star', $review->star ?? '') == 4 ? 'checked' : '' }}>
                        <label class="form-rating__label" for="star4">★</label>
                        <input class="form-rating__input" id="star3" name="star" type="radio" value=3 {{ old('star', $review->star ?? '') == 3 ? 'checked' : '' }}>
                        <label class="form-rating__label" for="star3">★</label>
                        <input class="form-rating__input" id="star2" name="star" type="radio" value=2 {{ old('star', $review->star ?? '') == 2 ? 'checked' : '' }}>
                        <label class="form-rating__label" for="star2">★</label>
                        <input class="form-rating__input" id="star1" name="star" type="radio" value=1 {{ old('star', $review->star ?? '') == 1 ? 'checked' : '' }}>
                        <label class="form-rating__label" for="star1">★</label>
                    </div>
                </div>
                <div class="review__form-item">
                    <h2 class="review__form-ttl">口コミを投稿</h2>
                    <div class="form__error">
                        @error('comment')
                            {{ $message }}
                        @enderror
                    </div>
                    <textarea class="review__form--textarea" name="comment" placeholder="カジュアルな夜のお出かけにおすすめのスポット">{{ old('comment', $review->comment ?? '') }}</textarea>
                    <p class="review__form--textarea__annotation">0/400（最高文字数）</p>
                </div>
                <div class="review__form-item">
                    <h2 class="review__form-ttl">画像の追加</h2>
                    <div class="form__error">
                        @error('image')
                            {{ $message }}
                        @enderror
                    </div>
                    <div id="drop-area" class="review__form--drop-area">
                        <div id="uploadMessage" class="upload-message">
                            <span>クリックして写真を追加</span><br><span class="upload-message__last">またはドラッグアンドドロップ</span>
                        </div>
                        <input type="file" name="image" id="imageInput" hidden>
                        <div id="gallery" class="gallery"></div>
                        <img id="preview" class="preview" src="{{ isset($review) && $review->image ? asset($review->image) : '' }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="form__button">
        <button class="form__button-submit" type="submit" form="reviewForm">口コミを投稿</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('imageInput');
    const preview = document.getElementById('preview');
    const dropArea = document.getElementById('drop-area');
    const uploadMessage = document.getElementById('uploadMessage'); // メッセージの要素を取得

    // **現在のページのお店IDを取得**
    const currentShopId = "{{ $shop->id }}"; // Laravelで現在の shop_id を Blade から取得

    // **前回の shop_id を取得**
    const storedShopId = sessionStorage.getItem('review_shop_id');

    // **もし前回の shop_id と現在の shop_id が違う場合、画像をリセット**
    if (storedShopId !== currentShopId) {
        sessionStorage.removeItem('review_image');
        sessionStorage.setItem('review_shop_id', currentShopId); // **新しい shop_id を保存**
    }

    // **既存の画像URLを取得**
    const existingImageUrl = "{{ isset($review) && $review->image ? asset($review->image) : '' }}";

    function restoreImageFromSession() {
        if (sessionStorage.getItem('review_image')) {
            const imageData = sessionStorage.getItem('review_image');
            preview.src = imageData;
            preview.style.display = 'block';
            uploadMessage.style.display = 'none';

            // **sessionStorage に保存されているファイル名を取得**
            const filename = sessionStorage.getItem('review_filename') || "uploaded_image.png";

            // **Base64データを File オブジェクトに変換し、input にセット**
            fetch(imageData)
                .then(res => res.blob())
                .then(blob => {
                    const file = new File([blob], filename, { type: blob.type });

                    // **Fileオブジェクトを input[type="file"] にセット**
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    input.files = dataTransfer.files;
                });
        } else if (existingImageUrl) {
            preview.src = existingImageUrl;
            preview.style.display = 'block';
            uploadMessage.style.display = 'none';
        } else {
            preview.style.display = 'none';
            uploadMessage.style.display = 'block';
        }
    }

    restoreImageFromSession(); // **ページ読み込み時に画像を復元**

    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];

            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                uploadMessage.style.display = 'none';

                // **ユニークなファイル名を作成**
                const timestamp = new Date().toISOString().replace(/[-:.TZ]/g, '');
                const randomString = Math.random().toString(36).substring(2, 8);
                const filename = `review_${timestamp}_${randomString}.${file.name.split('.').pop()}`;

                // **sessionStorage に画像データとファイル名を保存**
                sessionStorage.setItem('review_image', e.target.result);
                sessionStorage.setItem('review_filename', filename);
                sessionStorage.setItem('review_shop_id', currentShopId);

                // **Fileオブジェクトを input[type="file"] にセット**
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(new File([file], filename, { type: file.type }));
                input.files = dataTransfer.files;
            };
            reader.readAsDataURL(file);
        }
    }

    input.addEventListener('change', function (e) {
        handleFiles(e.target.files);
    });

    // ドラッグ＆ドロップ時の処理
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, e => {
            e.preventDefault();
            dropArea.classList.add('highlight');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, e => {
            e.preventDefault();
            dropArea.classList.remove('highlight');
        });
    });

    dropArea.addEventListener('drop', function (e) {
        e.preventDefault();
        handleFiles(e.dataTransfer.files);
    });

    dropArea.addEventListener('click', function () {
        input.click();
    });
});
</script>
<script src="{{ asset('js/like.js') }}"></script>
@endsection
