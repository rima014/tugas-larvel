@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create Tag</h1>
    </div>
    <div class="col-8">
        <form method="post" action="{{ route('tag.store') }}" class="mb-5" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name tag</label>
                <input type="text" class="form-control  @error('name') is-invalid
                @enderror" id="name"name="name" required autofocus value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create Tag</button>
        </form>
    </div>

    <script>
        const title = document.querySelector("#name");
        const slug = document.querySelector("#slug");

        title.addEventListener("keyup", function() {
            fetch('/dashboard/categories/checkSlug?name= + name.value')
            let preslug = title.value;
            preslug = preslug.replace(/ /g,"-");
            slug.value = preslug.toLowerCase();
        });

        title.addEventListener('trix-file-accept', function(e) {
            e.prevenDefault();
        })
    </script>
@endsection
