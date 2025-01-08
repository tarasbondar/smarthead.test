<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Support\Facades\Log;


class IndexController extends Controller
{

    public function index() {
        $movies = Movie::where('status', '=', 1)->get();
        return view('app.index', ['movies' => $movies]);
    }

}
