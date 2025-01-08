@extends('layouts.admin')

@section('content')

    <div class="container">

        <h2>{{ucfirst($action)}} genre</h2>

        <div class="row justify-content-center">
            <div class="col-md-10">

                <form method="POST" action="/admin/genre/store" enctype = 'multipart/form-data'>
                    @csrf
                    <div class="form-group row" hidden>
                        <input id="id" type="text" class="form-control" name="id" value="{{ @$genre['id'] }}" readonly>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                        <div class="col-md-6"> <input id="title" type="text" class="form-control" name="title" value="{{ @$genre['title'] }}" required> </div>
                    </div>

                    {{--<div class="form-group row">
                        <label for="status" class="col-md-4 col-form-label text-md-right">Active</label>
                        <div class="col-md-6 form-check"> <input type="checkbox" class="form-check-input marginleft0 margintop07rem" id="status" name="status" value="1" {{@$genre['status'] ? 'checked' : ''}}> </div>
                    </div>--}}

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

