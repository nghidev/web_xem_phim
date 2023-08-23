@extends('layouts.be')

@section('content')


    <main class="container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        @if (!isset($movie))
                        <div class="card-header">{{ __('Thêm Phim') }}</div>

                        @else
                        <div class="card-header">{{ __('Cập nhật phim') }}</div>

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
                            <a href="{{ route('movie.create') }}" class="btn btn-success">Thêm phim</a>

                            <!-- Trong view -->
                            @if (session('index'))
                            
                            @elseif(session('add'))
                            @if (!isset($movie))
                                {{-- {!! Form::open(['route' => 'movie.store', 'method' => 'POST']) !!} --}}
                                {!! Form::open(['route' => 'movie.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            @else
                                {!! Form::open(['route' => ['movie.update', $movie->id], 'method' => 'POST',  'enctype' => 'multipart/form-data']) !!}
                            @endif
                            <div class="form-froup">
                                {!! Form::label('title', 'Tiêu đề', []) !!}
                                {!! Form::text('title', isset($movie) ? $movie->title : ' ', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập vào tiêu đề',
                                    'id' => 'title',
                                ]) !!}
                            </div>
                            <div class="form-froup">
                                {!! Form::label('slug', 'Slug', []) !!}
                                {!! Form::text('slug', isset($movie) ? $movie->slug : ' ', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập vào tiêu đề',
                                    'id' => 'slug',
                                ]) !!}
                            </div>
                            {{-- <div class="form-froup">
                                {!! Form::label('link', 'Link phim', []) !!}
                                {!! Form::textarea('link', isset($movie) ? $movie->link : ' ', [
                                    'class' => 'form-control',
                                    'placeholders' => 'Nhập vào tiêu đề',
                                ]) !!}
                            </div> --}}
                            <div class="form-group">
                                {!! Form::label('description', 'Mô tả', []) !!}
                                {!! Form::textarea('description', isset($movie) ? $movie->description : ' ', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập vào mô tả',
                                    'id' => 'description-editor'
                                ]) !!}
                            </div>
                            <div class="form-froup">
                                {!! Form::label('status', 'Trạng thái', []) !!}
                                {!! Form::select(
                                    'status',
                                    ['1' => 'Hiển thị', '0' => 'Không hiển thị'],
                                    isset($movie) ? $movie->description : null,
                                    ['class' => 'form-control'],
                                ) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('category', 'Danh mục', []) !!}
                                {{-- {!! Form::select(
                                    'category',
                                    $categories, // Sử dụng biến $categories thay cho $category
                                    isset($category) ? $category : '',
                                    ['class' => 'form-control']
                                ) !!} --}}
                                {{ Form::select('category', $categories, 
                                isset($selectedCategory)? $selectedCategory: '', 
                                ['class' => 'form-control', 'id' => 'category-select']) }}

                            </div>
                            <div class="form-group">
                                {!! Form::label('country', 'Quốc gia', []) !!}
                                {{-- {!! Form::select(
                                    'country',
                                    $countries, // Sử dụng biến $countries thay cho $country
                                    isset($movie) ? $movie->country_id : '',
                                    ['class' => 'form-control']
                                ) !!} --}}
                                {!! Form::select('country', $countries, 
                                isset($selectedCountry)? $selectedCountry: '', 
                                ['class' => 'form-control', 'id' => 'country-select']) !!}

                            </div>
                            <div class="form-group">
                                {!! Form::label('genre', 'Thể loại', []) !!}
                                {{-- {!! Form::select(
                                    'genre',
                                    $genres, // Sử dụng biến $genres thay cho $genre
                                    isset($movie) ? $movie->genre_id : '',
                                    ['class' => 'form-control']
                                ) !!} --}}
                                {!! Form::select('genre', $genres, 
                                isset($selectedGenre) ? $selectedGenre: '', 
                                ['class' => 'form-control', 'id' => 'genre-select']) !!}

                            </div>
                            
                            <div class="form-group">
                                {!! Form::label('image', 'Hình ảnh', []) !!}
                                {!! Form::file('image', ['class' => 'form-control']) !!}
                            </div>
                            
                            <br>
                            @if (!isset($movie))
                                {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-success', 'id' => 'add-button']) !!}
                            @else
                                {!! Form::submit('Cập nhật dữ liệu', ['class' => 'btn btn-success', 'id' => 'submit-update']) !!}
                            @endif



                            {!! Form::close() !!}
                            @endif
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
                        <th scope="col">Ảnh</th>
                        <th scope="col">Mô tả</th>
                        {{-- <th scope="col">Link</th> --}}
                        <th scope="col">Năm Phim</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Ngày Tạo</th>
                        <th scope="col">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $movie)
                        <tr>
                            <th scope="row">{{ $movie->id }}</th>
                            <td>{{ $movie->title }}</td>
                            <td>{{ $movie->slug }}</td>
                            <td>
                                @if ($movie->image)
                                    <img src="{{ asset('storage/images/' . $movie->image) }}" alt="Movie Image" style="max-width: 100px; max-height: 100px;">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                @if (mb_strlen($movie->description) > 50)
                                    {{ mb_substr($movie->description, 0, 50) }}.....
                                @else
                                    {{ $movie->description }}
                                @endif
                            </td>
                            {{-- <td>
                                @if (mb_strlen($movie->link) > 50)
                                    {{ mb_substr($movie->link, 0, 50) }}.....
                                @else
                                    {{ $movie->link }}
                                @endif
                            </td> --}}

                            <td>
                                @if ($movie->status)
                                    Hiển thị
                                @else
                                    Không hiển thị
                                @endif
                            </td>
                            <td>
                                {{ $movie->ngaycapnhat }}
                                 
                            </td>
                            <td> 
                                {!! Form::selectRange('year', 2000, 2022, ' ',["class"=>"select_year", "id"=>$movie->id] )!!}
                               
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-warning me-2 rounded-4">sửa</a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['movie.destroy', $movie->id],
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
        <div class="pagination justify-content-center">
            {{ $list->links('pagination::bootstrap-4') }}
        </div>




    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/speakingurl@14.0.1/speakingurl.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#description-editor').summernote();
        });
    </script>
{{-- //sử dụng jquery lấy slug --}}
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
                if (confirm("Bạn có đồng ý thêm Phim này không?")) {
                    form.unbind("submit").submit();
                }
            });
        });
    </script>
    {{-- // dùng ajax lấy năm  --}}
    <script> 
    
        $(".select_year").change(function(){
            var year = $(this).find(":selected").val()
            var id = $(this).attr("id")
            alert(year)
            alert(id)
        })
    
    </script>
@endsection
