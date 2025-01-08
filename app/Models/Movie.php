<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model {

    protected $table = 'movies';

    protected $fillable = ['title', 'description', 'image', 'status'];

    public function genres(): BelongsToMany {
        return $this->belongsToMany(Genre::class, 'movies_2_genres');
    }

}
