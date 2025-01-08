<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin'
        ]);

        DB::table('movies')->insert([[
            'title' => 'Movie1',
            'description' => 'Descr1',
            'status' => 1,
            'created_at' => now()
        ],[
            'title' => 'Movie2',
            'description' => 'Descr2',
            'status' => 1,
            'created_at' => now()
        ],[
            'title' => 'Movie3',
            'description' => 'Descr3',
            'status' => 0,
            'created_at' => now()
        ],[
            'title' => 'Movie4',
            'description' => 'Descr4',
            'status' => 0,
            'created_at' => now()
        ]]);

        DB::table('genres')->insert([[
            'title' => 'Genre1',
            'created_at' => now()
        ],[
            'title' => 'Genre2',
            'created_at' => now()
        ],[
            'title' => 'Genre3',
            'created_at' => now()
        ],[
            'title' => 'Genre4',
            'created_at' => now()
        ]]);

        DB::table('movies_2_genres')->insert([[
            'movie_id' => 1,
            'genre_id' => 1,
            'created_at' => now()
        ],[
            'movie_id' => 2,
            'genre_id' => 2,
            'created_at' => now()
        ],[
            'movie_id' => 2,
            'genre_id' => 3,
            'created_at' => now()
        ],[
            'movie_id' => 3,
            'genre_id' => 3,
            'created_at' => now()
        ],[
            'movie_id' => 4,
            'genre_id' => 1,
            'created_at' => now()
        ],[
            'movie_id' => 4,
            'genre_id' => 4,
            'created_at' => now()
        ]]);
    }
}
