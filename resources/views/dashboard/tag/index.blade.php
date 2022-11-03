@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Post Tag</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-6" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-responsive col-lg-6">
        <a href="{{ route('tag.create') }}" class="btn btn-primary mb-3">Create tag</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name Tag</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag )
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>
                            <a href="{{ route('tag.edit', $tag->id) }}" class="babge bg-warning"><span data-feather="edit" class="align-text-bottom"></a></span>
                            <form action="{{ route('tag.destroy', $tag->id) }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="babge bg-danger border-0" onclick="return confirm ('Are you sure?')"><span data-feather="x-circle" class="align-text-bottom"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

