@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/admin_admin.css') }}">
@endsection

@section('content')
<div class="admin__content">
    <div class="admin-header">
        <h1 class="admin-heading">
            店舗代表者一覧
        </h1>
        <div class="register-form">
            <form action="/admin/representative/register" method="get">
                @csrf
                <button class="register__form--button" type="submit">店舗代表者登録</button>
            </form>
        </div>
        <form class="logout__form" action="/admin/logout" method="post">
            @csrf
            <button class="logout__button">管理者ログアウト</button>
        </form>
    </div>

    <div class="representative-table">
        <table class="representative-table__inner">
            <tr class="representative-table__row">
                <th class="representative-table__header">Id</th>
                <th class="representative-table__header">Name</th>
                <th class="representative-table__header">Email</th>
            </tr>
            @foreach ($representatives as $representative)
            <tr class="representative-table__row">
                <td class="representative-table__text">
                    {{ $representative->id }}
                </td>
                <td class="representative-table__text">
                    {{ $representative->name }}
                </td>
                <td class="representative-table__text">
                    {{ $representative->email }}
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
