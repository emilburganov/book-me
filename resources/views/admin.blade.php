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
    <div class="container h-max flex col g-40">
        <div class="flex col g-20">
            <div class="title">Жанры</div>
            <div class="f2f5">
                <form method="POST" action="{{ route('store-genres') }}" class="form card">
                    @csrf
                    <h3 class="title">Форма добавления жанров</h3>
                    <div class="input-group">
                        <label>Название:</label>
                        <input type="text" class="input" name="name">
                    </div>
                    <button class="button">Добавить</button>
                </form>
                <div class="grid-temp">
                    @foreach($genres as $genre)
                        <div class="card h-fit flex col g-20 sb">
                            <div class="flex col g-10">
                                <div class="key-value">
                                    <span>Название:</span>
                                    <p>{{ $genre->name }}</p>
                                </div>
                            </div>
                            <a href="{{ route('delete-genres', ['genre' => $genre->id]) }}" class="button danger">Удалить</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex col g-20">
            <div class="title">Авторы</div>
            <div class="f2f5">
                <form method="POST" action="{{ route('store-authors') }}" class="form card">
                    @csrf
                    <h3 class="title">Форма добавления авторов</h3>
                    <div class="input-group">
                        <label>Имя:</label>
                        <input type="text" class="input" name="name">
                    </div>
                    <div class="input-group">
                        <label>Фамилия:</label>
                        <input type="text" class="input" name="surname">
                    </div>
                    <div class="input-group">
                        <label>Отчество:</label>
                        <input type="text" class="input" name="patronymic">
                    </div>
                    <button class="button">Добавить</button>
                </form>
                <div class="grid-temp">
                    @foreach($authors as $author)
                        <div class="card h-fit flex col g-20 sb">
                            <div class="flex col g-10">
                                <div class="key-value">
                                    <span>Имя:</span>
                                    <p>{{ $author->name }}</p>
                                </div>
                                <div class="key-value">
                                    <span>Фамилия:</span>
                                    <p>{{ $author->surname }}</p>
                                </div>
                                <div class="key-value">
                                    <span>Отчество:</span>
                                    <p>{{ $author->patronymic }}</p>
                                </div>
                            </div>
                            <a href="{{ route('delete-authors', ['author' => $author->id]) }}" class="button danger">Удалить</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex col g-20">
            <div class="title">Книги</div>
            <div class="f2f5">
                <form enctype="multipart/form-data" method="POST" action="{{ route('store-books') }}" class="form card">
                    @csrf
                    <h3 class="title">Форма добавления книг</h3>
                    <div class="input-group">
                        <label>Название:</label>
                        <input type="text" class="input" name="name">
                    </div>
                    <div class="input-group">
                        <label>Описание:</label>
                        <textarea class="input" name="description"></textarea>
                    </div>
                    <div class="input-group">
                        <label>Картинка:</label>
                        <input type="file" class="input" name="image">
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
                    <div class="flex ac g-20 wrap">
                        <input type="checkbox" class="checkbox" name="is_shown">
                        <label>Показывать на главной</label>
                    </div>
                    <button class="button">Добавить</button>
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
                            </div>
                            <a
                                href="{{ route('delete-books', ['book' => $book->id]) }}" class="button danger"
                            >Удалить</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex col g-20">
            <div class="title">Пользователи</div>
            <div class="grid-temp">
                @foreach($users as $user)
                    <div class="card h-fit flex col g-20 sb">
                        <div class="flex col g-10">
                            <div class="key-value">
                                <span>Логин:</span>
                                <p>{{ $user->login }}</p>
                            </div>
                        </div>
                        <button onclick="toggleModal({{$user->id}})" class="button danger">Удалить</button>
                    </div>

                    <div data-id="{{$user->id}}" class="modal center" id="modal">
                        <div class="card flex ac g-20">
                            <a href="{{ route('delete-users', ['user' => $user->id]) }}" class="button danger">Удалить
                                                                                                               пользователя</a>
                            <button onclick="toggleModal({{$user->id}})" class="button">Отмена</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</main>

@include('includes.footer')

<script src="{{ asset('public/assets/js/index.js') }}"></script>
</body>
</html>