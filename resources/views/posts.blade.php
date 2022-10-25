@extends('layouts.app')

@section('content')

    {{-- category --}}
    <h1 class="mb-3 text-center">{{ $title }}</h1>
    @if(request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
    @endif
    {{-- author --}}
    @if(request('author'))
        <input type="hidden" name="author" value="{{ request('author') }}">
    @endif
    {{-- search --}}
    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/posts">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..."name="search" value="{{ request('search') }}">
                    <button class="btn btn-danger" type="submit">Search</button>
                  </div>
            </form>
        </div>
    </div>
    {{--card image --}}
    @if ($posts->count())
        <div class="card mb-3 text-center border-0">
            <div style="max-height: 300px; overflow:hidden;">
                @if ($posts[0]->image)
                    <img src="{{ asset('storage/' . $posts[0]->image) }}" alt="{{ $posts[0]->category->name }}" class="img-fluid">

                @else
                    <img src="https://source.unsplash.com/random/1200x400?{{ $posts[0]->category->name }}" class="card-img-top" alt="{{ $posts[0]->category->name }}">
                @endif
            </div>
        </div>
        {{-- card body --}}
        <div class="card-body text-center">
            <h3 class="card-title"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h3>
                <p>
                    <small class="text-muted mb-3">
                        By. <a href="/posts?author={{ $posts[0]->author->username }}"class="text-decoration-none">{{ $posts[0]->author->name }}</a> in <a href="/posts?category={{ $posts[0]->category->slug }}"class="text-decoration-none">{{ $posts[0]->category->name ?? 'username not found' }}</a>{{ $posts[0]->created_at->diffForHumans() }}
                    </small>
                </p>
                <p class="card-text">{{ $posts[0]->excerpt }}</p>
                <a href="/posts/{{ $posts[0]->slug}}"class="text-decoration-none btn btn-primary">Read more</a>
            </div>

            <div class="container mt-4">
                <div class="row">
                    @foreach ($posts->skip(1) as $post)
                    <div class="col-md-4 mb-3">
                        <div class="card-deck">
                            <div class="postion-absolute px-3 py-2 align-center mb-3" style="background-color: rgba(0,0,0,0.7)"><a href="/posts?category={{ $post->category->slug }}" class="text-white text-decoration-none ">{{  $post->category->name }}</a></div>
                                @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="mx-auto d-block">
                                @else
                                <img src="https://source.unsplash.com/random/500x400?{{ $post->category->name }}" class="card-img-top mt-3" alt="{{ $post->category->name }}">
                                @endif

                            {{-- card title --}}
                            <div class="card-body mb-3">
                                <h5 class= "text-decoration-none text-dark">{{ $post->title }}</h5>
                                <p>
                                    <small class="text-muted">
                                        By. <a href="/posts?author={{ $post->author->username }}"class="text-decoration-none">{{ $post->author->name }}</a>{{ $post->created_at->diffForHumans() }}
                                    </small>
                                </p>
                                {{-- card text --}}
                                <p class="card-text">{{ $post->excerpt }}</p>
                                <a href="posts/{{ $post->slug}}" class="btn btn-primary">Read more</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <p class="text-center fs-4">No post found.</p>
    @endif
    {{ $posts->links() }}
@endsection



