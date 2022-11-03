<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get(),
            'tags' => Tags::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tags::all();
        $categories = Category::all();

        return view('dashboard.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        // return $request->file('image')->store('post-images');
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image|file|max:1024',
            'body' => 'required',
            'tags' => 'required',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        $posts = Post::create($validatedData);

        foreach ($request->tags as $currentTag) {
            $param = [];
            if (Tags::find($currentTag) == null) {
                $param = ['name' => $currentTag, 'slug' => $currentTag];
            } else {
                $param = ['id' => $currentTag];
            }
            $tag = Tags::firstOrCreate($param);
            $posts->tags()->attach($tag->id);
        }

        return redirect('/dashboard/posts')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tags::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required',
        ];

        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);
        // $tags = explode('#', $request->tags);
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        $newTags = [];
        foreach ($request->tags as $currentTag) {
            $param = [];
            if (Tags::find($currentTag) == null) {
                $param = ['name' => $currentTag, 'slug' => $currentTag];
            } else {
                $param = ['id' => $currentTag];
            }
            $tag = Tags::firstOrCreate($param);
            array_push($newTags, $tag->id);
        }
        $post->tags()->sync($newTags);
        Post::where('id', $post->id)->update($validatedData);

        return redirect('/dashboard/posts')->with('success', 'Post has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::delete($post->image);
        }
        $post->tags()->detach();
        Post::destroy($post->id);

        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    }
}
