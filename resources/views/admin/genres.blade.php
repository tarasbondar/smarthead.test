@extends('layouts.admin')

@section('content')

    <div class="container">

        <h2>Genres</h2>

        <div class="row">
            <div class="col-md-12 text-right mt-3 mb-3">
                <a href="/admin/genre/add" class="btn btn-primary" type="button">Add genre</a>
            </div>
        </div>

        @if (!empty($genres))
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Created</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>

                <tbody>
                    @foreach ($genres as $genre)
                        <tr>
                            <th scope="row">{{ $genre->id }}</th>
                            <td>{{ $genre->title }}</td>
                            <td>{{ $genre->created_at }}</td>
                            <td>
                                <a href="/admin/genre/edit/{{ $genre['id'] }}">Edit</a>
                                <a href="#" class="remove-genre" data-id="{{ $genre['id'] }}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {!! $genres->links() !!}
        @endif


        <script>
            (function(){

                $(document).on('click', '.remove-genre', function(){

                    if (confirm('Are you sure?')) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/admin/genre/destroy',
                            data: {'id': $(this).data('id')},
                            method: 'DELETE',
                            success: function (response) {
                                window.location.href = '/admin/genres/';
                            }
                        });
                    }
                });

            })(jQuery)
        </script>
    </div>
@endsection

