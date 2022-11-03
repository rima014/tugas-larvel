<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag = Tags::paginate(10);

        return view('dashboard.tag.index', [
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
        return view('dashboard.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tags $tags)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:tags',
        ]);
        // $validatedData['user_id'] = auth()->user()->id;
        Tags::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name), // 'required|unique:tags',
        ]); // ($validatedData);

        return redirect()->route('tag.index')->with('success', 'tag has been Create!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Tags $tags)
    {
        return view('dashboard.tag.edit', compact('tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tags $tags)
    {
        $data = $request->validate([
            'name' => 'required|unique:categories',
        ]);
        $data['slug'] = str()->slug($data['name']);
        $tags->update($data);

        return redirect()->route('tag.index')->with('success', ' has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tags $tags)
    {
        $tags->delete();

        return redirect()->route('tag.index')
            ->with('success', 'tag deleted successfully');
    }
}
