<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenresController extends Controller
{

    public function index() {
        $genres = Genre::paginate($perPage = 3, $columns = ['*'], $pageName = 'page');
        return view('admin.genres', ['genres' => $genres]);
    }

    public function add() {
        return view('admin.edit-genre', ['action' => 'add']);
    }

    public function edit($id) {
        $genre = Genre::findOrFail($id);
        return view('admin.edit-genre', ['action' => 'edit', 'genre' => $genre]);
    }

    public function store(Request $request) {
        $request->validate([
            'id' => 'nullable|exists:genres,id',
            'title' => 'required|string'
        ]);

        if (empty($request->get('id'))) {
            $genre = new Genre();
        } else {
            $genre = Genre::find($request->get('id'));
        }

        $genre->title = $request->get('title');
        $genre->save();
        return redirect()->route('admin.genres.index');
    }

    public function destroy(Request $request) {
        $genre = Genre::findOrFail($request->get('id'));
        $genre->delete();
        return '';
    }
}
