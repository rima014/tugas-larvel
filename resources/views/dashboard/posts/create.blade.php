@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Post</h1>
    </div>
    <div class="col-8">
        <form method="post" action="/dashboard/posts" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control  @error('title') is-invalid
                @enderror" id="title"name="title" required autofocus value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control @error('Slug') is-invalid
                @enderror" id="slug" name="slug" required value="{{ old('slug') }}" disabled>
                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" name="category_id">
                    @foreach ($categories as $category)
                        @if (old('category_id') == $category->id)
                            <option value="{{ $category->id }}"selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('category')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- <div class="mb-3">
                <label for="tags" class="form-label">tags</label>
                <select class="form-select selectpicker" multiple="multiple" name="tags[]" >
                @foreach ($tags as $tag )
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
                </select>
                @error('tags')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div> --}}
            <div class="form-group">
                <label for="tags">Tag</label>
                <select class="form-select select2" name="tags[]" multiple="multiple">
                @foreach ($tags as $tag )
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
                </select>
                @error('tags')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Post Image</label>
                <img class="img-preview img-fluid mb-3 col-sm-5">
                <input class="form-control @error('image') is-invalid
                @enderror" type="file" id="image" name="image" onchange="previewImage()">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                @error('body')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <input id="body" type="hidden" name="body" value={{ old('body') }}>
                <trix-editor input="body"></trix-editor>
            </div>

            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
        const title = document.querySelector("#title");
        const slug = document.querySelector("#slug");


        title.addEventListener("keyup", function() {
            fetch('/dashboard/posts/checkSlug?title= + title.value')
            let preslug = title.value;
            preslug = preslug.replace(/ /g,"-");
            slug.value = preslug.toLowerCase();
        });

        title.addEventListener('trix-file-accept', function(e) {
            e.prevenDefault();
        })

        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.didplay = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);


            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>

    <script>
        $(document).ready(function(){
            $('.select2').select2({
                placeholder: "Select Tags",
                tags: true
            });
        });
    </script>
@endsection
