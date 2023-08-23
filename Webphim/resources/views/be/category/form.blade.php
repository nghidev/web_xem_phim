
@extends('layouts.be')

@section('content')
    <main class="container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        @if (!isset($category))
                            <div class="card-header">{{ __('Thêm danh mục') }}</div>
                        @else
                            <div class="card-header">{{ __('Cập nhật danh mục') }}</div>
                        @endif
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @elseif (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif


                            <a href="{{ route('category.create') }}" class="btn btn-success">Thêm danh mục</a>

                            <!-- Trong view -->
                           

                            @if (session('index'))
                            
                            @elseif(session('add'))
                                @if (!isset($category))
                                    {!! Form::open(['route' => 'category.store', 'method' => 'POST']) !!}
                                @else
                                    {!! Form::open(['route' => ['category.update', $category->id], 'method' => 'POST']) !!}
                                @endif
                                <div class="form-froup">
                                    {!! Form::label('title', 'Tiêu đề', []) !!}
                                    {!! Form::text('title', isset($category) ? $category->title : ' ', [
                                        'class' => 'form-control',
                                        'placeholder' => 'Nhập vào tiêu đ',
                                        'id' => 'title',
                                    ]) !!}
                                </div>
                                <div class="form-froup">
                                    {!! Form::label('slug', 'Slug', []) !!}
                                    {!! Form::text('slug', isset($category) ? $category->slug : ' ', [
                                        'class' => 'form-control',
                                        // 'placeholder' => 'Nhập vào tiêu đề',
                                        'id' => 'slug',
                                    ]) !!}
                                </div>
                                <div class="form-froup">
                                    {!! Form::label('description', 'Mô tả', []) !!}
                                    {!! Form::textarea('description', isset($category) ? $category->description : ' ', [
                                        'class' => 'form-control',
                                        'placeholders' => 'Nhập vào tiêu đề',
                                    ]) !!}
                                </div>
                                <div class="form-froup">
                                    {!! Form::label('status', 'Trạng thái', []) !!}
                                    {!! Form::select(
                                        'status',
                                        ['1' => 'Hiển thị', '0' => 'Không hiển thị'],
                                        isset($category) ? $category->description : null,
                                        ['class' => 'form-control'],
                                    ) !!}
                                </div>
                                <br>
                                @if (!isset($category))
                                    {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-success', 'id' => 'add-button']) !!}
                                @else
                                    {!! Form::submit('Cập nhật dữ liệu', ['class' => 'btn btn-success', 'id' => 'submit-update']) !!}
                                @endif



                                {!! Form::close() !!}
                            @endif

                            {{-- @if (!isset($category))
                                {!! Form::open(['route' => 'category.store', 'method' => 'POST']) !!}
                            @else
                                {!! Form::open(['route' => ['category.update', $category->id], 'method' => 'POST']) !!}
                            @endif
                            <div class="form-froup">
                                {!! Form::label('title', 'Tiêu đề', []) !!}
                                {!! Form::text('title', isset($category) ? $category->title : ' ', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập vào tiêu đ',
                                    'id' => 'title',
                                ]) !!}
                            </div>
                            <div class="form-froup">
                                {!! Form::label('slug', 'Slug', []) !!}
                                {!! Form::text('slug', isset($category) ? $category->slug : ' ', [
                                    'class' => 'form-control',
                                    // 'placeholder' => 'Nhập vào tiêu đề',
                                    'id' => 'slug',
                                ]) !!}
                            </div>
                            <div class="form-froup">
                                {!! Form::label('description', 'Mô tả', []) !!}
                                {!! Form::textarea('description', isset($category) ? $category->description : ' ', [
                                    'class' => 'form-control',
                                    'placeholders' => 'Nhập vào tiêu đề',
                                ]) !!}
                            </div>
                            <div class="form-froup">
                                {!! Form::label('status', 'Trạng thái', []) !!}
                                {!! Form::select(
                                    'status',
                                    ['1' => 'Hiển thị', '0' => 'Không hiển thị'],
                                    isset($category) ? $category->description : null,
                                    ['class' => 'form-control'],
                                ) !!}
                            </div>
                            <br>
                            @if (!isset($category))
                                {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-success', 'id' => 'add-button']) !!}
                            @else
                                {!! Form::submit('Cập nhật dữ liệu', ['class' => 'btn btn-success', 'id' => 'submit-update']) !!}
                            @endif



                            {!! Form::close() !!} --}}

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif


                        </div>
                    </div>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $category)
                        <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                @if ($category->status)
                                    Hiển thị
                                @else
                                    Không hiển thị
                                @endif
                            </td>
                            <td class="">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('category.edit', $category->id) }}"
                                        class="btn btn-warning me-2 rounded-4">Sửa</a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['category.destroy', $category->id],
                                        'onsubmit' => 'return confirm("Xóa?")',
                                        'style' => 'display:inline-block;',
                                    ]) !!}
                                    {!! Form::submit('Xóa', ['class' => 'btn btn-danger rounded-4']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </td>



                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>





    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/speakingurl@14.0.1/speakingurl.min.js"></script>

    <script>
        document.getElementById('title').addEventListener('input', function() {
            var title = this.value;
            var slug = getSlug(title, {
                lang: 'vn'
            });
            document.getElementById('slug').value = slug;
        });
    </script>
    <script>
        $(document).ready(function() {
            // Prevent form from submitting
            $("form").on("submit", function(event) {
                event.preventDefault();
            });

            // Show confirm dialog on submit button click
            $("#submit-update").on("click", function() {
                var form = $(this).closest("form");
                if (confirm("Bạn có đồng ý lưu thay đổi không?")) {
                    form.unbind("submit").submit();
                }
            });

            // Show confirm dialog on add button click
            $("#add-button").on("click", function() {
                var form = $(this).closest("form");
                if (confirm("Bạn có đồng ý thêm danh mục không?")) {
                    form.unbind("submit").submit();
                }
            });
        });
    </script>

@endsection
