<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie2Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class MoviesController extends Controller
{

    public function index() {
        $movies = Movie::paginate($perPage = 3, $columns = ['*'], $pageName = 'page');
        return view('admin.movies', ['movies' => $movies]);
    }

    public function add() {
        $genres = Genre::all();
        return view('admin.edit-movie')
            ->with('action', 'add')
            ->with('genres', $genres)
            ->with('genresCurrent', []);
    }

    public function edit($id) {
        $movie = Movie::findOrFail($id);
        $genres = Genre::all();
        $genresCurrent = $movie->genres()->pluck('id')->toArray();
        return view('admin.edit-movie')
            ->with('action', 'edit')
            ->with('movie', $movie)
            ->with('genres', $genres)
            ->with('genresCurrent', $genresCurrent);
    }

    public function store(Request $request) {
        $request->validate([
            'id' => 'nullable|exists:movies,id',
            'title' => 'required|string|max:128',
            'description' => 'required|string|max:255',
            'status' => Rule::in([0, 1]),
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        try {
            DB::beginTransaction();

            if (empty($request->get('id'))) {
                $movie = new Movie();
                $genresCurrent = [];
            } else {
                $movie = Movie::find($request->get('id'));
                $genresCurrent = $movie->genres()->pluck('id')->toArray();
            }

            if ($request->has('image')) {
                if (isset($movie->image)) {
                    File::delete(public_path('uploads') . '/' . $movie->image);
                }
                $filename = time() . '_' . $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads'), $filename);
                $movie->image = $filename;
            }

            $movie->title = $request->get('title');
            $movie->description = $request->get('description');
            $movie->status = $request->get('status', 0);
            $movie->save();

            $genresNew = array_keys($request->get('genres', []));

            if (array_diff($genresNew, $genresCurrent)) {
                $toAdd = array_filter(array_diff($genresNew, $genresCurrent));
                if (count($toAdd)) {
                    foreach ($toAdd as $genreId) {
                        Movie2Genre::create(['movie_id' => $movie->id, 'genre_id' => $genreId, 'created_at' => now()]);
                    }
                }
            }

            if (array_diff($genresCurrent, $genresNew)) {
                $toDelete = array_filter(array_diff($genresCurrent, $genresNew));
                if (count($toDelete)) {
                    $ids = implode(', ', $toDelete);
                    Movie2Genre::whereRaw("movie_id = {$movie->id} AND genre_id IN ($ids)")->delete();
                }
            }


            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::info($e->getMessage());
        }

        return redirect()->route('admin.movies.index');
    }

    public function changeStatus(Request $request) {
        $movie = Movie::findOrFail($request->get('id'));
        $movie->status = (int)!$movie->status;
        $movie->save();
        return true;
    }

    public function destroy(Request $request) {
        $request->validate([
            'id' => 'required|exists:movies,id'
        ]);

        $movie = Movie::find($request->get('id'));
        if (isset($movie->image)) {
            File::delete(public_path('uploads') . '/' . $movie->image);
        }
        $movie->delete();
        return '';
    }
}
