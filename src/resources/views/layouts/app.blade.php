<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <p class="header__logo">
                    Rese
                </p>
                @if (Auth::check())
                <div id="btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <nav class="header-nav">
                    <ul id="menu" class="header-nav__list">
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/">ホーム</a>
                        </li>
                        <li class="header-nav__item">
                            <form class="header-nav__form" action="/attendance" method="get">
                                @csrf
                                <div class="form__item">
                                    <input type="hidden" name="target_date" value="today">
                                    <button class="header-nav__button" type="submit">日付一覧</button>
                                </div>
                            </form>
                        </li>
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/user">ユーザー一覧</a>
                        </li>
                        <li class="header-nav__item">
                            <form class="header-nav__form" action="/logout" method="post">
                                @csrf
                                <button class="header-nav__button">ログアウト</button>
                            </form>
                        </li>
                    </ul>
                </nav>
                @endif
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer__inner">
            <small class="footer__logo">Atte, inc.</small>
        </div>
    </footer>

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
    </script>
</body>

</html>
