<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\Movie;
use Illuminate\Support\Facades\Validator;


class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->flash('index', 'Thêm form');

        $list = episode::all();
        $movie = Movie::pluck('title', 'id');
        return view('be.episode.form', compact('list', 'movie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function DisplayCreateForm()
    {

        return redirect()->route('episode.create')->with('add', 'Thêm');
    }
    public function create()
    {
        session()->flash('add', 'Thêm form');

        $list = episode::all();
        $movie = Movie::pluck('title', 'id');
        return view('be.episode.form', compact('list', 'movie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Kiểm tra các trường thông tin được gửi lên từ form
        $rules = [
            'status' => 'required|in:0,1',
            'episode' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255',
            'link' => 'required',
        ];
    
        $messages = [
            'status.required' => 'Vui lòng chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
            'episode.required' => 'Vui lòng nhập tập phim',
            'episode.min' => 'Tập phim phải có ít nhất 3 kí tự',
            'episode.max' => 'Tập phim không được vượt quá 255 kí tự',
            'slug.required' => 'Vui lòng nhập slug',
            'slug.min' => 'Slug phải có ít nhất 3 kí tự',
            'slug.max' => 'Slug không được vượt quá 255 kí tự',
            'link.required' => 'Vui lòng nhập link phim',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Tạo một đối tượng mới từ model Episode và lưu vào database
        $episode = new Episode();
        $episode->movie_id = $request->input('movie_id');
        $episode->episode = $request->input('episode');
        $episode->slug = $request->input('slug');
        $episode->link = $request->input('link');
        $episode->save();
    
        // Chuyển hướng về trang danh sách tập phim
        return redirect()->route('episode.create')->with('success', 'Tập phim đã được lưu thành công.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        session()->flash('add', 'Thêm form');
        $list = episode::all();
        $movie = Movie::pluck('title', 'id');
        $findEpisode = Episode::find($id);
        // Lấy ra đối tượng episode có id tương ứng
        $episode = episode::find($id);
        $selectedepisode = $findEpisode->movie_id;

        // Hiển thị thông tin danh mục sản phẩm cần cập nhật lên form
        return view('be.episode.form', compact('episode', 'list', 'movie', 'selectedepisode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Kiểm tra các trường thông tin được gửi lên từ form
        $rules = [
            'status' => 'required|in:0,1',
            'episode' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255',
            'link' => 'required',
        ];
    
        $messages = [
            'status.required' => 'Vui lòng chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
            'episode.required' => 'Vui lòng nhập tập phim',
            'episode.min' => 'Tập phim phải có ít nhất 3 kí tự',
            'episode.max' => 'Tập phim không được vượt quá 255 kí tự',
            'slug.required' => 'Vui lòng nhập slug',
            'slug.min' => 'Slug phải có ít nhất 3 kí tự',
            'slug.max' => 'Slug không được vượt quá 255 kí tự',
            'link.required' => 'Vui lòng nhập link phim',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Tìm tập phim cần cập nhật theo ID
        $episode = Episode::findOrFail($id);
        $episode->movie_id = $request->input('movie_id');
        $episode->episode = $request->input('episode');
        $episode->slug = $request->input('slug');
        $episode->link = $request->input('link');
        $episode->save();
    
        // Chuyển hướng về trang danh sách tập phim
        return redirect()->route('episode.create')->with('success', 'Cập nhật tập phim thành công.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
