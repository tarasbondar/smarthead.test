<?php

namespace App\Http\Controllers;

use App\Http\Resources\GenreApiResource;
use App\Http\Resources\MovieApiResource;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function genres() {
        $genres = Genre::all();
        return response()->json(GenreApiResource::collection($genres));
    }

    public function genre(Request $request) {
        $movies = Movie::query()
            ->select('movies.*')
            ->join('movies_2_genres AS m2g', 'movies.id', '=', 'm2g.movie_id')
            ->where('m2g.genre_id', '=', $request->get('id'))
            ->where('movies.status', '=', 1)
            ->offset(($request->get('page', 1) - 1) * $request->get('page_size', 3))
            ->limit($request->get('page_size', 3))
            ->get();
        return response()->json(MovieApiResource::collection($movies));
    }

    public function movies(Request $request) {
        $movies = Movie::query()
            ->where('movies.status', '=', 1)
            ->offset(($request->get('page', 1) - 1) * $request->get('page_size', 3))
            ->limit($request->get('page_size', 3))
            ->get();
        return response()->json(MovieApiResource::collection($movies));
    }

    public function movie($id) {
        $movie = Movie::find($id);
        return response()->json(MovieApiResource::make($movie));
    }

}
