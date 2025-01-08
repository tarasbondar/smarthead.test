@extends('layouts.app')

@section('content')

<div id="app">

    <header>
        <div class="header-container">
            <br>SMARTHEAD<br>TEST
        </div>
    </header>

    <main role="main" class="bg-striped">

        <div class="container margintop20">

            <div class="content">

                <div class="today-section margintop60">
                    @if (!empty($movies))
                        <div class="container">
                            <h3>Movies:</h3>
                            <div class="row">
                                @foreach($movies as $movie)
                                    <div class="movie-card col-4">
                                        <img src='{{ isset($movie['image']) ? "/uploads/{$movie['image']}" : '/images/default-image.jpg'}}' alt='{{ $movie->title }}' height="460" style="width: 100%">
                                        <h2>{{ $movie->title }}</h2>
                                        <p>{{ implode(' | ', $movie->genres->pluck('title')->toArray()) }}</p>
                                        <p>{{ $movie->description }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="footer-section margintop20">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="justify-content-center copyright">
                                    <span class="text-center">Copyright (c)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

<script src="{{ asset('js/app.js') }}"></script>

@endsection
