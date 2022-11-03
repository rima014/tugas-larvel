<?php

use App\Http\Controllers\CategoryAdminController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/categories', [HomeController::class, 'categori']);

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

Route::middleware('auth')->group(function () {
    Route::resource('/dashboard/posts', DashboardPostController::class);
    Route::get('/dashboard', function () {
        return view('dashboard.index', [
        ]);
    });

    Route::prefix('tag')->controller(\App\Http\Controllers\TagController::class)->name('tag.')
        ->group(function () {
            Route::get('/', 'index')->name('index')->middleware(['auth']);
            Route::get('create', 'create')->name('create')->middleware(['auth']);
            Route::post('/', 'store')->name('store')->middleware(['auth']);
            Route::get('{tags}/', 'show')->name('show');
            Route::get('{tags}/edit', 'edit')->name('edit');
            Route::patch('{tags}/update', 'update')->name('update');
            Route::delete('{tags}', 'destroy')->name('destroy')->middleware(['auth']);
        });
});
