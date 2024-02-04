<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         User::query()->create([
             'login' => 'admin',
             'password' => 'bookme',
             'is_admin' => true,
         ]);

         Author::query()->create([
             'name' => 'Ivan',
             'surname' => 'Ivanov',
             'patronymic' => 'Ivanovic',
         ]);

         Book::query()->create([
             'image' => 'images/6508873.jpg',
             'name' => 'Book 1',
             'description' => 'Description 1',
             'is_shown' => true,
             'author_id' => 1,
         ]);

        Book::query()->create([
            'image' => 'images/62780292.jpg',
            'name' => 'Book 2',
            'description' => 'Description 2',
            'is_shown' => true,
            'author_id' => 1,
        ]);

        Book::query()->create([
            'image' => 'images/65876893.jpg',
            'name' => 'Book 3',
            'description' => 'Description 3',
            'is_shown' => true,
            'author_id' => 1,
        ]);

        Book::query()->create([
            'image' => 'images/68437168.jpg',
            'name' => 'Book 4',
            'description' => 'Description 4',
            'is_shown' => true,
            'author_id' => 1,
        ]);

        Book::query()->create([
            'image' => 'images/68850156.jpg',
            'name' => 'Book 5',
            'description' => 'Description 5',
            'is_shown' => true,
            'author_id' => 1,
        ]);

        Book::query()->create([
            'image' => 'images/68865591.jpg',
            'name' => 'Book 6',
            'description' => 'Description 6',
            'is_shown' => true,
            'author_id' => 1,
        ]);

        Book::query()->create([
            'image' => 'images/cover.webp',
            'name' => 'Book 7',
            'description' => 'Description 7',
            'is_shown' => true,
            'author_id' => 1,
        ]);
    }
}
