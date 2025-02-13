@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/import_csv.css') }}">
@endsection

@section('content')
<div class="import-csv__content">
    <div class="import-csv__inner">
        <h1 class="import-csv__ttl">CSVインポート</h1>
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="import-csv__form">
            <form action="{{ route('import.csv') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form__label" for="csv_file">CSVファイルを選択：</label>
                    <input type="file" name="csv_file" class="form__input">
                </div>
                <button class="form__button-submit" type="submit">インポート</button>
            </form>
        </div>
    </div>
</div>
@endsection
