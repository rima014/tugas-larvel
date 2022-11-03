@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Posts</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-responsive col-lg-25">
        <a href="/dashboard/posts/create " class="btn btn-primary mb-3">Create new post</a>
        <table class="table table-striped table-sm">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">Tag</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post )
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->category->name ?? 'None' }}</td>
                <td>
                    @foreach ($post->tags as $tag)
                    <button type="button" class="btn btn-secondary mb-2">{{ $tag->name }}</button>
                    @endforeach
                </td>
            <td>
                <a href="/dashboard/posts/{{ $post->slug }}" class="babge bg-info text-center mb-2"><span data-feather="eye" class="align-text-bottom"></a></span>
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="babge bg-warning text-center mb-2"><span data-feather="edit" class="align-text-bottom"></a></span>
                <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline mb-2">
                    @method('delete')
                    @csrf
                    <button class="babge bg-danger border-0 text-center" onclick="return confirm ('Are you sure?')"><span data-feather="x-circle" class="align-text-bottom"></span></button>
                </form>
            </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
@endsection
