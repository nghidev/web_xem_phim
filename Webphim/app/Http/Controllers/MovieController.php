<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        session()->flash('index', 'Thêm form');

        $categories = Category::pluck('title', 'id');
        $countries = Country::pluck('title', 'id');
        $genres = Genre::pluck('title', 'id');
        // $list = Movie::all();
        $list = DB::table('movies')->paginate(5); 
        return view('be.movie.form', compact('list', 'countries', 'categories', 'genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function DisplayCreateForm()
    {

        return redirect()->route('movie.create')->with('add', 'Thêm');
    }
    public function create()
    {
        session()->flash('add', 'Thêm form');

        $categories = Category::pluck('title', 'id');
        $countries = Country::pluck('title', 'id');
        $genres = Genre::pluck('title', 'id');
        // $list = Movie::all();
        $list = DB::table('movies')->paginate(5); 
        return view('be.movie.form', compact('list', 'countries', 'categories', 'genres'));
    }
    public function saveImageFromForm($file)
    {
        // Kiểm tra xem file có tồn tại không
        if ($file && $file->isValid()) {
            $path = $file->store('public/images'); // Lưu ảnh vào thư mục public/images

            // Lấy tên file hình ảnh
            $filename = basename($path);

            // Trả về đường dẫn tới file hình ảnh
            return '/storage/images/' . $filename;
        }

        // Trả về giá trị mặc định nếu không có file
        return null;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // public function store(Request $request)
    // {
    //     // if ($request->hasFile('image')) {
    //     //     // Lấy file ảnh từ request
    //     //     $image = $request->file('image');

    //     //     // Lưu ảnh và nhận lại đường dẫn tới file
    //     //     $imageUrl = $this->saveImageFromForm($image);
    //     //     return $imageUrl;
    //     //     // Lưu đường dẫn tới file ảnh vào CSDL hoặc thực hiện các xử lý khác
    //     //     // ...
    //     // }
    //     // // dd($request->input('status'));
    //     // // // Kiểm tra các trường thông tin được gửi lên từ form
    //     $rules = [
    //         'title' => 'required|min:3|max:255',
    //         'description' => 'required|min:10|max:1000',
    //         'status' => 'required|in:0,1',
    //     ];

    //     $messages = [
    //         'title.required' => 'Vui lòng nhập tiêu đề',
    //         'title.min' => 'Tiêu đề phải có ít nhất 3 kí tự',
    //         'title.max' => 'Tiêu đề không được vượt quá 255 kí tự',
    //         'description.required' => 'Vui lòng nhập mô tả',
    //         'description.min' => 'Mô tả phải có ít nhất 10 kí tự',
    //         'description.max' => 'Mô tả không được vượt quá 1000 kí tự',
    //         'status.required' => 'Vui lòng chọn trạng thái',
    //         'status.in' => 'Trạng thái không hợp lệ',
    //     ];

    //     $validator = Validator::make($request->all(), $rules, $messages);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     // Tạo một đối tượng mới từ model movie và lưu vào database

    //     // dd($request->input("title"));
    //     $movie = new movie();
    //     $movie->title = $request->input('title');
    //     $movie->slug = $request->input('slug');
    //     $movie->description = $request->input('description');
    //     $movie->status = $request->input('status');
    //     $movie->save();

    //     // // Chuyển hướng về trang danh sách danh mục sản phẩm
    //     return redirect()->route('movie.create');
    //     // ->with('success', 'Danh mục sản phẩm đã được lưu thành công.');
    // }
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|min:3|max:255',
            'slug' => 'required',
            // 'link' => 'required',
            'description' => 'required|min:10|max:1000',
            'status' => 'required|in:0,1',
            'category' => 'required',
            'country' => 'required',
            'genre' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $messages = [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'title.min' => 'Tiêu đề phải có ít nhất 3 kí tự',
            'title.max' => 'Tiêu đề không được vượt quá 255 kí tự',
            'slug.required' => 'Vui lòng nhập slug',
            // 'link.required' => 'Vui lòng nhập link phim',
            'description.required' => 'Vui lòng nhập mô tả',
            'description.min' => 'Mô tả phải có ít nhất 10 kí tự',
            'description.max' => 'Mô tả không được vượt quá 1000 kí tự',
            'status.required' => 'Vui lòng chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
            'category.required' => 'Vui lòng chọn danh mục',
            'country.required' => 'Vui lòng chọn quốc gia',
            'genre.required' => 'Vui lòng chọn thể loại',
            'image.required' => 'Vui lòng chọn hình ảnh',
            'image.image' => 'Tệp tải lên phải là hình ảnh',
            'image.mimes' => 'Định dạng hình ảnh không hợp lệ. Chấp nhận các định dạng: jpeg, png, jpg, gif',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageUrl = $this->saveImageFromForm($image);
            if ($imageUrl === null) {
                return redirect()->back()->with('error', 'Đã xảy ra lỗi khi tải lên hình ảnh')->withInput();
            }

            $imageUrl = basename($imageUrl); // Lấy chỉ tên tệp ảnh, không bao gồm đường dẫn
        } else {
            $imageUrl = null;
        }

        $movie = new Movie();
        $movie->title = $request->input('title');
        $movie->slug = $request->input('slug');
        // $movie->link = $request->input('link');
        $movie->description = $request->input('description');
        $movie->status = $request->input('status');
        $movie->category_id = $request->input('category');
        $movie->country_id = $request->input('country');
        $movie->genre_id = $request->input('genre');
        $movie->image = $imageUrl;
        $movie->save();

        return redirect()->route('movie.create')->with('success', 'Dữ liệu đã được lưu thành công.');
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
        $movie = Movie::find($id);

        // $categories = Category::pluck('title', 'id'); // Lấy danh sách các category từ CSDL
        // $selectedCategory = $movie->category_id; // Lấy giá trị category được chọn cho phim từ CSDL


       

        $categories = Category::pluck('title', 'id');
        $countries = Country::pluck('title', 'id');
        $genres = Genre::pluck('title', 'id');
        $selectedCategory = $movie->category_id; // Lấy giá trị category được chọn cho phim từ CSDL
        $selectedCountry = $movie->country_id; // Lấy giá trị country được chọn cho phim từ CSDL
        $selectedGenre = $movie->genre_id; // Lấy giá trị genre được chọn cho phim từ CSDL


        $list = Movie::paginate(10); 


        // Kiểm tra xem đối tượng phim có tồn tại hay không
        if (!$movie) {
            return redirect()->route('movie.index')->with('error', 'Không tìm thấy phim.');
        }

        // Hiển thị thông tin phim cần chỉnh sửa lên form
        // return view('be.movie.form', compact('movie', 'category', 'categories', 'selectedCategory', 'countries', 'genres', 'list'));
        return view('be.movie.form', compact('categories', 'countries', 'genres', 'selectedCategory', 'selectedCountry', 'selectedGenre', 'list', 'movie'));
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
    $rules = [
        'title' => 'required|min:3|max:255',
        'slug' => 'required',
        // 'link' => 'required',
        'description' => 'required|min:10|max:1000',
        'status' => 'required|in:0,1',
        'category' => 'required',
        'country' => 'required',
        'genre' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ];

    $messages = [
        'title.required' => 'Vui lòng nhập tiêu đề',
        'title.min' => 'Tiêu đề phải có ít nhất 3 kí tự',
        'title.max' => 'Tiêu đề không được vượt quá 255 kí tự',
        'slug.required' => 'Vui lòng nhập slug',
        // 'link.required' => 'Vui lòng nhập link phim',
        'description.required' => 'Vui lòng nhập mô tả',
        'description.min' => 'Mô tả phải có ít nhất 10 kí tự',
        'description.max' => 'Mô tả không được vượt quá 1000 kí tự',
        'status.required' => 'Vui lòng chọn trạng thái',
        'status.in' => 'Trạng thái không hợp lệ',
        'category.required' => 'Vui lòng chọn danh mục',
        'country.required' => 'Vui lòng chọn quốc gia',
        'genre.required' => 'Vui lòng chọn thể loại',
        'image.image' => 'Tệp tải lên phải là hình ảnh',
        'image.mimes' => 'Định dạng hình ảnh không hợp lệ. Chấp nhận các định dạng: jpeg, png, jpg, gif',
        'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $movie = Movie::find($id);

    if (!$movie) {
        return redirect()->route('movie.index')->with('error', 'Không tìm thấy phim.');
    }

    if ($request->hasFile('image')) {
        $image = $request->file('image');

        if ($image->isValid()) {
            // Kiểm tra xem ảnh đã tồn tại trong CSDL và trong public hay chưa
            if ($movie->image && Storage::exists('public/images/' . $movie->image)) {
                Storage::delete('public/images/' . $movie->image);
            }

            $newImageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $newImageName);

            $movie->image = $newImageName;
        } else {
            return redirect()->back()->with('error', 'Hình ảnh không hợp lệ')->withInput();
        }
    }

    $movie->title = $request->input('title');
    $movie->slug = $request->input('slug');
    // $movie->link = $request->input('link');
    $movie->description = $request->input('description');
    $movie->status = $request->input('status');
    $movie->category_id = $request->input('category');
    $movie->country_id = $request->input('country');
    $movie->genre_id = $request->input('genre');
    // $movie->ngaytao = Carbon::now("Asia/Ho_Chi_Minh");
    $movie->ngaycapnhat = Carbon::now("Asia/Ho_Chi_Minh");
    $movie->save();

    return redirect()->route('movie.edit', ['id' => $movie->id])->with('success', 'Cập nhật phim thành công.');
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
    public function taoapi()
    {
        $movies = Movie::all();
        return response()->json($movies);
    }
}
