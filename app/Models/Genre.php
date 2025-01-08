<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{

    protected $table = 'genres';

    protected $fillable = ['title'];

    public function movies() {
        return $this->belongsToMany(Movie::class, 'movies_2_genres');
    }

}
