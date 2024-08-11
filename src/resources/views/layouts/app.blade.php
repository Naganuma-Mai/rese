<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet"> -->
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
                    <ul id="menu" class="header-nav__list">
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/">Home</a>
                        </li>
                        <!-- ログイン後 -->
                        @if (Auth::check())
                        <li class="header-nav__item">
                            <form class="header-nav__form" action="/logout" method="post">
                                @csrf
                                <button class="header-nav__button">Logout</button>
                            </form>
                        </li>
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/mypage">Mypage</a>
                        </li>

                        <!-- ログイン前 -->
                        @else
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/register">Registration</a>
                        </li>
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/login">Login</a>
                        </li>
                        @endif
                    </ul>
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
        const links = document.querySelectorAll("#menu a");

        btn.addEventListener("click", () => {
            btn.classList.toggle("on");
            menu.classList.toggle("on");
        });

        links.forEach((link) => {
            link.addEventListener("click", () => {
                btn.classList.toggle("on");
                menu.classList.toggle("on");
            });
        });
    </s>
</body>

</html>
