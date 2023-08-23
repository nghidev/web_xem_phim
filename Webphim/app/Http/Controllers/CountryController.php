<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;


class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->flash('index', 'Thêm form');

        $list = country::all();
        return view('be.country.form', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function DisplayCreateForm()
    {

        return redirect()->route('country.create')->with('add', 'Thêm phim');
    }

    public function create()
    {
        session()->flash('add', 'Thêm form');

        $list = country::all();
        return view('be.country.form', compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        // Kiểm tra các trường thông tin được gửi lên từ form
        $rules = [
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10|max:1000',
            'status' => 'required|in:0,1',
        ];

        $messages = [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'title.min' => 'Tiêu đề phải có ít nhất 3 kí tự',
            'title.max' => 'Tiêu đề không được vượt quá 255 kí tự',
            'description.required' => 'Vui lòng nhập mô tả',
            'description.min' => 'Mô tả phải có ít nhất 10 kí tự',
            'description.max' => 'Mô tả không được vượt quá 1000 kí tự',
            'status.required' => 'Vui lòng chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Tạo một đối tượng mới từ model country và lưu vào database

        // dd($request->input("title"));
        $country = new country();
        $country->title = $request->input('title');
        $country->slug = $request->input('slug');
        $country->description = $request->input('description');
        $country->status = $request->input('status');
        $country->save();

        // // Chuyển hướng về trang danh sách danh mục sản phẩm
        return redirect()->route('country.create');
        // ->with('success', 'Danh mục sản phẩm đã được lưu thành công.');
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
        $list = country::all();

        // Lấy ra đối tượng country có id tương ứng
        $country = country::find($id);
        // dd($country->title);
        // Nếu không tìm thấy đối tượng, chuyển hướng về trang danh sách danh mục sản phẩm
        // if (!$country) {
        //     return redirect()->route('country.index')->with('error', 'Không tìm thấy danh mục sản phẩm.');
        // }

        // Hiển thị thông tin danh mục sản phẩm cần cập nhật lên form
        return view('be.country.form', compact('country', 'list'));
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
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10|max:1000',
            'status' => 'required|in:0,1',
        ];

        $messages = [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'title.min' => 'Tiêu đề phải có ít nhất 3 kí tự',
            'title.max' => 'Tiêu đề không được vượt quá 255 kí tự',
            'description.required' => 'Vui lòng nhập mô tả',
            'description.min' => 'Mô tả phải có ít nhất 10 kí tự',
            'description.max' => 'Mô tả không được vượt quá 1000 kí tự',
            'status.required' => 'Vui lòng chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Tìm đối tượng country có id tương ứng
        $country = country::find($id);

        // Nếu không tìm thấy đối tượng, chuyển hướng về trang danh sách danh mục sản phẩm
        if (!$country) {
            return redirect()->route('country.update')->with('error', 'Không tìm thấy danh mục sản phẩm.');
        }

        // Cập nhật thông tin danh mục sản phẩm và lưu vào database
        $country->title = $request->input('title');
        $country->slug = $request->input('slug');
        $country->description = $request->input('description');
        $country->status = $request->input('status');
        $country->save();

        // Chuyển hướng về trang danh sách danh mục sản phẩm
        return redirect()->route('country.edit', ['id' => $country->id])->with('success', 'Cập nhật quốc gia thành công.');
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
