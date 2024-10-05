<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('head')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <div id="btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <p class="header__logo">
                    Rese
                </p>
                <nav class="header-nav">
                    <!-- ログイン後 -->
                    @if (Auth::check())
                    <ul id="menu" class="header-nav__list">
                        <li class="header-nav__item">
                            <form class="header-nav__form" action="/" method="get">
                                @csrf
                                <button class="header-nav__button">Home</button>
                            </form>
                        </li>
                        <li class="header-nav__item">
                            <form class="header-nav__form" action="/logout" method="post">
                                @csrf
                                <button class="header-nav__button">Logout</button>
                            </form>
                        </li>
                        <li class="header-nav__item">
                            <form class="header-nav__form" action="/mypage" method="get">
                                @csrf
                                <button class="header-nav__button">Mypage</button>
                            </form>
                        </li>
                    </ul>

                    <!-- ログイン前 -->
                    @else
                    <ul id="menu" class="header-nav__list">
                        <li class="header-nav__item">
                            <form class="header-nav__form" action="/" method="get">
                                @csrf
                                <button class="header-nav__button">Home</button>
                            </form>
                        </li>
                        <li class="header-nav__item">
                            <form class="header-nav__form" action="/register" method="get">
                                @csrf
                                <button class="header-nav__button">Registration</button>
                            </form>
                        </li>
                        <li class="header-nav__item">
                            <form class="header-nav__form" action="/login" method="get">
                                @csrf
                                <button class="header-nav__button">Login</button>
                            </form>
                        </li>
                    </ul>
                    @endif
                </nav>
            </div>
            @yield('form')
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <script>
        const btn = document.getElementById("btn");
        const menu = document.getElementById("menu");

        btn.addEventListener("click", () => {
            btn.classList.toggle("on");
            menu.classList.toggle("on");
        });
    </script>
</body>

</html>
