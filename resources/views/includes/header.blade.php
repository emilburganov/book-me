<header>
    <div class="header__container">
        <a href="{{ route('home') }}" class="logo">
            Book<span>Me</span>
        </a>

        <div class="flex g-20 ac">
            @guest
                <a href="{{ route('get-login') }}" class="button">Логин</a>
                <a href="{{ route('get-register') }}" class="button">Регистрация</a>
            @endguest
            @auth
                <a href="{{ route('show-selected') }}" class="button">Избранные книги</a>
                <a href="{{ route('get-logout') }}" class="button">Выйти</a>
            @endauth

            <a href="{{ route('books') }}" class="button">Все книги</a>
        </div>
</header>