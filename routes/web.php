<?php

use App\Http\Controllers\CategoryAdminController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
// });
Route::get('/about', function () {
    return view('about', [
        'title' => 'about',
        'active' => 'about',
    ]);
});
Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Post Categories',
        'active' => 'categories',
        'categories' => Category::all(),
    ]);
});
Route::get('/', [HomeController::class, 'index']);
Route::prefix('posts')->controller(PostController::class)->name('posts.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{posts:slug}', 'show')->name('show');
});
Route::middleware('guest')->group(function () {
    Route::prefix('login', 'logout')->controller(LoginController::class)->name('login.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'authenticate')->name('authenticate');
    });
});
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::middleware('admin')->group(function () {
    Route::prefix('dashboard/categories')->controller(CategoryAdminController::class)->name('categories.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/{categories:slug}/edit', 'edit')->name('edit');
        Route::patch('/{categories:slug}', 'update')->name('update');
        Route::delete('/{categories:slug}', 'destroy')->name('destroy');
    });
});

Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');
Route::get('/dashboard', function () {
    return view('dashboard.index', [
    ]);
})->middleware('auth');
