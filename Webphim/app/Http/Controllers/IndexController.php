<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Movie;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Episode;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $movies = Movie::orderBy('id', 'Desc')->get();
        $categories = Category::orderBy('id', 'Desc')->get();
        $genres = Genre::orderBy('id', 'Desc')->get();
        $countries = Country::orderBy('id', 'Desc')->get();

        $danhmuc = Movie::select('movies.*')
            ->join('categories', 'movies.category_id', '=', 'categories.id')
            ->where('categories.id', 2)
            ->orderBy('movies.category_id', 'DESC')
            ->get();

        $phimle = Movie::select('movies.*')
            ->join('categories', 'movies.category_id', '=', 'categories.id')
            ->where('categories.id', 1)
            ->orderBy('movies.category_id', 'DESC')
            ->get();


        $chieurap = Movie::select('movies.*')
            ->join('categories', 'movies.category_id', '=', 'categories.id')
            ->where('categories.id', 3)
            ->orderBy('movies.category_id', 'DESC')
            ->get();

        return view('fe.index', compact('categories', 'genres', 'countries', 'movies', 'danhmuc', 'phimle', 'chieurap'));
    }
    public function categories($id, $slug)
    {
        $categories = Category::orderBy('id', 'Desc')->get();
        $genres = Genre::orderBy('id', 'Desc')->get();
        $countries = Country::orderBy('id', 'Desc')->get();

        // Lấy danh sách phim theo danh mục
        // $movies = Movie::select('movies.*')
        //     ->join('categories', 'movies.category_id', '=', 'categories.id')
        //     ->where('categories.id', $id)
        //     ->orderBy('movies.category_id', 'DESC')
        //     ->get();

        $movies = DB::table('movies')
        ->select('movies.*')
        ->join('categories', 'movies.category_id', '=', 'categories.id')
        ->where('categories.id', $id)
        ->orderBy('movies.category_id', 'desc')
        ->paginate(2); 
        
        $danhmuc = Category::find($id);

        return view('fe.category', compact('categories', 'genres', 'countries', 'movies', 'danhmuc'));
    }
    public function detail($id, $slug)
    {
        $detail = Movie::find($id);
        $categories = Category::orderBy('id', 'Desc')->get();
        $genres = Genre::orderBy('id', 'Desc')->get();
        $countries = Country::orderBy('id', 'Desc')->get();
        
        $slugofepi = Movie::select('episodes.*')
        ->join('episodes', 'movies.id', '=', 'episodes.movie_id')
        ->where('episodes.movie_id', $id)
        ->orderBy('movies.id', 'DESC')
        ->first();

        return view('fe.detail', compact('categories', 'genres', 'countries', 'detail', 'slugofepi'));
    }
    public function watch($id, $slug)
    {
        $watch = Movie::find($id);
        $categories = Category::orderBy('id', 'Desc')->get();
        $genres = Genre::orderBy('id', 'Desc')->get();
        $countries = Country::orderBy('id', 'Desc')->get();

        $link = Movie::select('episodes.*')
            ->join('episodes', 'movies.id', '=', 'episodes.movie_id')
            ->where('episodes.movie_id', $id)
            ->orderBy('movies.id', 'DESC')
            ->first();

        // if ($link) {
        //     // Thực hiện các thao tác với $link
        //     // Ví dụ: $link->link, $link->episode, ...
        // } else {
        //     // Xử lý khi không có mảng đầu tiên
        // }


        return view('fe.watch', compact('categories', 'genres', 'countries', 'watch', 'link'));
    }
    public function Genre($id, $slug)
    {
        $watch = Movie::find($id);
        $categories = Category::orderBy('id', 'Desc')->get();
        $genres = Genre::orderBy('id', 'Desc')->get();
        $countries = Country::orderBy('id', 'Desc')->get();

        // Lấy danh sách phim theo danh mục
        $movies = Movie::select('movies.*')
            ->join('genres', 'movies.genre_id', '=', 'genres.id')
            ->where('genres.id', $id)
            ->orderBy('movies.category_id', 'DESC')
            ->get();
        $theloai = Genre::find($id);
        return view('fe.category', compact('categories', 'genres', 'countries', 'watch', 'movies', 'theloai'));
    }
    public function Country($id, $slug)
    {
        $watch = Movie::find($id);
        $categories = Category::orderBy('id', 'Desc')->get();
        $genres = Genre::orderBy('id', 'Desc')->get();
        $countries = Country::orderBy('id', 'Desc')->get();

        // Lấy danh sách phism theo danh mục
        $movies = Movie::select('movies.*')
            ->join('countries', 'movies.country_id', '=', 'countries.id')
            ->where('countries.id', $id)
            ->orderBy('movies.category_id', 'DESC')
            ->get();
        $quocgia = Country::find($id);
        return view('fe.category', compact('categories', 'genres', 'countries', 'watch', 'movies', 'quocgia'));
    }
    public function episode($id, $slug, $episode_id)
    {
        $episodeplus = Movie::find($id);
        $categories = Category::orderBy('id', 'Desc')->get();
        $genres = Genre::orderBy('id', 'Desc')->get();
        $countries = Country::orderBy('id', 'Desc')->get();

        $link = Movie::select('episodes.*')
        ->join('episodes', 'movies.id', '=', 'episodes.movie_id')
        ->where('episodes.movie_id', $id)
        ->where('episodes.id', $episode_id) // Thêm điều kiện này để lọc theo $episode_id
        ->orderBy('movies.id', 'DESC')
        ->first();

        // if ($link) {
        //     // Thực hiện các thao tác với $link
        //     // Ví dụ: $link->link, $link->episode, ...
        // } else {
        //     // Xử lý khi không có mảng đầu tiên
        // }


        return view('fe.episode', compact('categories', 'genres', 'countries', 'episodeplus', 'link'));
    }
}
