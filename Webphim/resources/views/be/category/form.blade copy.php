@extends('layouts.app')

@section('content')
    <main class="container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Thêm thể Loại') }}</div>

                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (!$category)
                            {!! Form::open(['route' => 'category.store', 'method' => 'POST']) !!}
                              
                            @endif
                            <div class="form-froup">
                                {!! Form::label('title', 'Tiêu đề', []) !!}
                                {!! Form::text('title', isset($category) ? $category->id : " ", ['class' => 'form-control', 'placeholders' => 'Nhập vào tiêu đề']) !!}
                            </div>
                            <div class="form-froup">
                                {!! Form::label('description', 'Mô tả', []) !!}
                                {!! Form::textarea('description', ' ', ['class' => 'form-control', 'placeholders' => 'Nhập vào tiêu đề']) !!}
                            </div>
                            <div class="form-froup">
                                {!! Form::label('status', 'Trạng thái', []) !!}
                                {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không hiển thị'], null, ['class' => 'form-control']) !!}
                            </div>
                            <br>
                            {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-success', 'id' => 'submit-button']) !!}



                            {!! Form::close() !!}

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
                            <td>{{ $category->description }}</td>
                            <td>
                                @if ($category->status)
                                    Hiển thị
                                @else
                                    Không hiển thị
                                @endif
                            </td>
                            <td>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['category.destroy', $category->id],
                                    'onsubmit' => 'return confirm("Xóa?")',
                                ]) !!}
                                {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                {{-- {!! Form::submit('Cập nhật', ['class' => 'btn btn-warning']) !!} --}}
                                {!! Form::close() !!}
                                <a href="{{ route("category.edit",$category->id) }}" class="btn btn-warning">Cập nhật</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>




    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Prevent form from submitting
            $("form").on("submit", function(event) {
                event.preventDefault();
            });

            // Show confirm dialog on submit button click
            $("#submit-button").on("click", function() {
                if (confirm("Bạn có đồng ý thêm thể loại phim không?")) {
                    $("form").unbind("submit").submit();
                }
            });
        });
    </script>

@endsection
