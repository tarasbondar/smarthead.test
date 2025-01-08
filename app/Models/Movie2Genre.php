<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie2Genre extends Model
{
    protected $table = 'movies_2_genres';

    protected $fillable = ['movie_id', 'genre_id', 'created_at'];

    public $timestamps = false;

}
