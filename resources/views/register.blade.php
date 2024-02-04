<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
    <title>BookMe</title>
</head>
<body>
<main>
    <div class="container center">
        <form method="POST" action="{{ route('post-register') }}" class="form card">
            @csrf
            <h3 class="title">Форма регистрации</h3>
            <div class="input-group">
                <label>Логин:</label>
                <input type="text" class="input" name="login" placeholder="Username">
                @if($errors->has('login'))
                    <div class="input-error">{{ $errors->first('login') }}</div>
                @endif
            </div>
            <div class="input-group">
                <label>Пароль:</label>
                <input type="password" class="input" name="password" placeholder="********">
                @if($errors->has('password'))
                    <div class="input-error">{{ $errors->first('password') }}</div>
                @endif
            </div>
            <div class="input-group">
                <label>Повторение пароля:</label>
                <input type="password" class="input" name="password_confirmation" placeholder="********">
                @if($errors->has('password_confirmation'))
                    <div class="input-error">{{ $errors->first('password_confirmation') }}</div>
                @endif
            </div>
            <button class="button">Зарегистрироваться</button>
        </form>
    </div>
</main>
</body>
</html>