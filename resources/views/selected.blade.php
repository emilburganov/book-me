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
    <div class="container h-max">
        <div class="container h-max flex col g-40">
            <div class="flex col g-20">
                @if ($books->count())
                    <div class="title">Избранные книги</div>
                @else
                    <div class="error">Нет книг в избранных.</div>
                @endif
                <div class="grid-temp">
                    @foreach($books as $book)
                        <div class="card h-fit flex col g-20 sb">
                            <img src="{{ asset('public/' . $book->image) }}" alt="book">
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
                                    <a
                                        href="{{ route('remove-from-selected', ['book' => $book->id]) }}"
                                        class="danger button"
                                    >Удалить из избранных</a>
                                @endauth
                                <a
                                    href="{{ route('show-book', ['book' => $book->id]) }}" class="button"
                                >Перейти</a>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="flex">
                    @if ($books->count())
                        @auth
                            <a
                                href="{{ route('remove-all-from-selected') }}" class="danger button"
                            >Удалить все из избранных</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>

@include('includes.footer')
</body>
</html>