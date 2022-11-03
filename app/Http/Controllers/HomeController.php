<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'title' => 'home',
            'active' => 'home',
        ]);
    }

    public function about()
    {
        return view('about', [
            'title' => 'About',
            'active' => 'about',
            'name' => "Rima Ramba'",
            'asal' => 'Sulawesi selatan',
            'email' => 'rimaramba14@gmail.com',
            'image' => 'rima.jpg',
        ]);
    }

    public function categori()
    {
        return view('categories', [
            'title' => 'Post Categories',
            'active' => 'categories',
            'categories' => Category::all(),
        ]);
    }
}
