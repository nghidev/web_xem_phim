<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
//Adimin controller 
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\IndexController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('admin', [HomeController::class, 'index'])->name('admin');



Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/categories/{id}/{slug}', [IndexController::class, 'categories'])->name('categories');
Route::get('/detail/{id}/{slug}', [IndexController::class, 'detail'])->name('detail');
Route::get('/watch/{id}/{slug}', [IndexController::class, 'watch'])->name('watch');
Route::get('/genres/{id}/{slug}', [IndexController::class, 'genre'])->name('genres');
Route::get('/countries/{id}/{slug}', [IndexController::class, 'country'])->name('countries');
Route::get('/episode/{id}/{slug}/{episode_id}', [IndexController::class, 'episode'])->name('episode');



// Route Admin
// Quản lý danh mục

Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::post('/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('/category/DisplayCreateForm', [CategoryController::class, 'DisplayCreateForm'])->name('category.DisplayCreateForm');
// Route::resource('category', CategoryController::class);
// Route::put('/category/{category}', 'CategoryController@update')->name('category.update');




// Quản lý thể loại phim
Route::get('/genre/index', [GenreController::class, 'index'])->name('genre.index');
Route::get('/genre/create', [GenreController::class, 'create'])->name('genre.create');
Route::post('/genre/create', [GenreController::class, 'store'])->name('genre.store');
Route::get('/genre/edit/{id}', [GenreController::class, 'edit'])->name('genre.edit');
Route::post('/genre/update/{id}', [GenreController::class, 'update'])->name('genre.update');
Route::post('/genre/destroy/{id}', [GenreController::class, 'destroy'])->name('genre.destroy');
Route::get('/genre/DisplayCreateForm', [GenreController::class, 'DisplayCreateForm'])->name('genre.DisplayCreateForm');



// Quản lý quốc gia
Route::get('/country/index', [CountryController::class, 'index'])->name('country.index');
Route::get('/country/create', [CountryController::class, 'create'])->name('country.create');
Route::post('/country/create', [CountryController::class, 'store'])->name('country.store');
Route::get('/country/edit/{id}', [CountryController::class, 'edit'])->name('country.edit');
Route::post('/country/update/{id}', [CountryController::class, 'update'])->name('country.update');
Route::post('/country/destroy/{id}', [CountryController::class, 'destroy'])->name('country.destroy');
Route::get('/country/DisplayCreateForm', [CountryController::class, 'DisplayCreateForm'])->name('country.DisplayCreateForm');


// Quản lý phim
Route::get('/movie/index', [MovieController::class, 'index'])->name('movie.index');
Route::get('/movie/create/', [MovieController::class, 'create'])->name('movie.create');

Route::post('/movie/create', [MovieController::class, 'store'])->name('movie.store');
Route::get('/movie/edit/{id}', [MovieController::class, 'edit'])->name('movie.edit');
Route::post('/movie/update/{id}', [MovieController::class, 'update'])->name('movie.update');
Route::post('/movie/destroy/{id}', [MovieController::class, 'destroy'])->name('movie.destroy');
Route::get('/movie/DisplayCreateForm', [MovieController::class, 'DisplayCreateForm'])->name('movie.DisplayCreateForm');

// Quản lý tập phim
Route::get('/episode/index', [EpisodeController::class, 'index'])->name('episode.index');
Route::get('/episode/create/', [EpisodeController::class, 'create'])->name('episode.create');
Route::post('/episode/create', [EpisodeController::class, 'store'])->name('episode.store');
Route::get('/episode/edit/{id}', [EpisodeController::class, 'edit'])->name('episode.edit');
Route::post('/episode/update/{id}', [EpisodeController::class, 'update'])->name('episode.update');
Route::post('/episode/destroy/{id}', [EpisodeController::class, 'destroy'])->name('episode.destroy');
Route::get('/episode/DisplayCreateForm', [EpisodeController::class, 'DisplayCreateForm'])->name('episode.DisplayCreateForm');

