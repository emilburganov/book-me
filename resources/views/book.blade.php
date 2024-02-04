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
@include('includes.header')

<main>
    <div class="container center h-max">
        <div class="container h-max flex col g-40">
            <div class="flex col g-20">
                <div class="card h-fit flex col g-20 sb">
                    <img src="{{ asset('public/' . $book->image) }}" alt="book">
                    <div class="flex col g-10">
                        <div class="flex col g-20">
                            <div class="key-value">
                                <span>Название:</span>
                                <p>{{ $book->name }}</p>
                            </div>
                            <div class="key-value">
                                <span>Описание:</span>
                                <p>{{ $book->description }}</p>
                            </div>
                            <div class="key-value">
                                <span>Автор:</span>
                                <p>{{ $book->author->full_name }}</p>
                            </div>
                            <div class="key-value">
                                <span>Жанры:</span>
                                <p>
                                    @foreach($book->genres as $genre)
                                        {{$genre->name . ' '}}
                                    @endforeach
                                </p>
                            </div>
                            @auth
                                @if (!$isSelected)
                                    <a
                                        href="{{ route('add-to-selected', ['book' => $book->id]) }}" class="button"
                                    >Добавить в избранные</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('includes.footer')
</body>
</html>