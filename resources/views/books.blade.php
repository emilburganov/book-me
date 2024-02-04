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
                <div class="title">Все книги</div>
                <div class="f2f5">
                    <form method="GET" action="{{ route('books') }}" class="form card">
                        <h3 class="title">Фильтры и сортировка</h3>
                        <div class="input-group">
                            <label>Сортировка:</label>
                            <select class="input" name="sorting">
                                <option value="desc">Сначала новые</option>
                                <option value="asc">Сначала старые</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Автор:</label>
                            <select class="input" name="author">
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->full_name  }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Жанры:</label>
                            <select class="input" name="genres[]" multiple>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}">{{ $genre->name  }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="button">Применить</button>
                    </form>
                    <div class="grid-temp">
                        @foreach($books as $book)
                            <div class="card h-fit flex col g-20 sb">
                                <img src="{{ asset('public/' . $book->image) }}" alt="book">
                                <div class="flex col g-10">
                                    <div class="key-value">
                                        <span>Название:</span>
                                        <p>{{ $book->name }}</p>
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
                                </div>
                                <a
                                    href="{{ route('show-book', ['book' => $book->id]) }}" class="button"
                                >Перейти</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{ $books->withQueryString()->links() }}
            </div>
        </div>
</main>

@include('includes.footer')
</body>
</html>