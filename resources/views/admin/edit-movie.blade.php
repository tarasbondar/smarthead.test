@extends('layouts.admin')

@section('content')

    <div class="container">

        <h2>{{ucfirst($action)}} movie</h2>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <form method="POST" action="/admin/movie/store" enctype = 'multipart/form-data'>
                    @if ($errors->any())
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-6">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                    @csrf
                    <div class="form-group row" hidden>
                        <input id="id" type="text" class="form-control" name="id" value="{{ @$movie['id'] }}" readonly>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-4 col-form-label text-md-right">Title</label>
                        <div class="col-6"> <input id="title" type="text" class="form-control" name="title" value="{{ @$movie['title'] }}" required> </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-4 col-form-label text-md-right">Description</label>
                        <div class="col-6"> <textarea id="description" type="text" class="form-control " name="description" rows="6" required> {{ @$movie['description'] }} </textarea> </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Current Image</label>
                        <div class="col-6"> <div class="form-control">{{ $movie['image'] ?? 'none' }} </div></div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-4 col-form-label text-md-right">Choose Image</label>
                        <div class="col-6"> <input id="image" type="file" name="image"></div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-4 col-form-label text-md-right">Active</label>
                        <div class="col-6 form-check"> <input type="checkbox" class="form-check-input marginleft0 margintop07rem" id="status" name="status" value="1" {{@$movie['status'] ? 'checked' : ''}}> </div>
                    </div>

                    <div class="form-group row">
                        <span class="col-4 col-form-label text-md-right">Genres</span>
                        <div class="col-6 form-check">
                            <div class="row">
                                @foreach($genres as $genre)
                                    <div class="col-6">
                                        <label for="genres" class="col-3 col-form-label">{{$genre->title}}</label>
                                        <input type="checkbox" class="form-check-input col-9" id="genres" name="genres[{{$genre->id}}]" value="1" {{in_array($genre->id, $genresCurrent) ? 'checked' : ''}}>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

