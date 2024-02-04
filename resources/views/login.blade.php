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
        <form method="POST" action="{{ route('post-login') }}" class="form card">
            @csrf
            <h3 class="title">Форма авторизации</h3>
            <div class="input-group">
                <label>Логин:</label>
                <input type="text" class="input" name="login" placeholder="Username">
            </div>
            <div class="input-group">
                <label>Пароль:</label>
                <input type="password" class="input" name="password" placeholder="********">
            </div>
            <button class="button">Авторизоваться</button>
            @if($errors->has('message'))
                <div class="error">{{ $errors->first('message') }}</div>
            @endif
        </form>
    </div>
</main>
</body>
</html>