@extends('layouts.admin')

@section('content')

    <div class="container">

        <h2>Movies</h2>

        <div class="row">
            <div class="col-md-12 text-right mt-3 mb-3">
                <a href="/admin/movie/add" class="btn btn-primary" type="button">Add movie</a>
            </div>
        </div>

        @if (!empty($movies))
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Genres</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($movies as $movie)
                    <tr>
                        <th scope="row">{{ $movie->id }}</th>
                        <td>{{ $movie->title }}</td>
                        <td>{{ substr($movie->description, 0, 100 ) }}</td>
                        <td>{{ implode(', ', $movie->genres()->pluck('title')->toArray()) }}</td>
                        <td>
                            <input class="form-check-input movie-status-switch" type="checkbox" role="switch" data-id="{{ $movie->id }}" id="status-{{ $movie->id }}" {{ $movie->status ? 'checked' : '' }}>
                            <label class="form-check-label" for="status-{{ $movie->id }}" hidden>Active</label>
                            <span class="movie-status">{{ $movie->status ? 'Active' : 'Inactive' }}</span>
                        </td>
                        <td>
                            <a href="/admin/movie/edit/{{ $movie['id'] }}">Edit</a>
                            <a href="#" class="remove-movie" data-id="{{ $movie['id'] }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $movies->links() !!}
        @endif


        <script>
            (function(){

                $(document).on('click', '.remove-movie', function(){

                    if (confirm('Are you sure?')) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/admin/movie/destroy',
                            data: {'id': $(this).data('id')},
                            method: 'DELETE',
                            success: function (response) {
                                window.location.href = '/admin/movies/';
                            }
                        });
                    }
                });

                $(document).on('click', '.movie-status-switch', function(){
                    let statusSwitch = $(this);
                    let status = statusSwitch.is(':checked');

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '/admin/movie/change-status',
                        data: {'id': statusSwitch.data('id')},
                        method: 'POST',
                        success: function () {
                            if (status === true) {
                                statusSwitch.parent().find('.movie-status').text('Active');
                            } else {
                                statusSwitch.parent().find('.movie-status').text('Inactive');
                            }
                        }
                    });
                })

            })(jQuery)
        </script>
    </div>
@endsection

