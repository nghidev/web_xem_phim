@extends('layouts.be')

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
                            {{-- @foreach ($category as $item) --}}
                            {!! Form::open(['route' => 'category.store', 'method' => 'POST']) !!}
                            <div class="form-froup">
                                {!! Form::label('title', 'Tiêu đề', []) !!}
                                {!! Form::text('title', $category->title, ['class' => 'form-control', 'placeholders' => 'Nhập vào tiêu đề']) !!}
                            </div>
                            <div class="form-froup">
                                {!! Form::label('description', 'Mô tả', []) !!}
                                {!! Form::textarea('description', $category->description, ['class' => 'form-control', 'placeholders' => 'Nhập vào tiêu đề']) !!}
                            </div>
                            <div class="form-froup">
                                {!! Form::label('status', 'Trạng thái', []) !!}
                                {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không hiển thị'], $category->status, ['class' => 'form-control']) !!}
                            </div>
                            <br>
                            {!! Form::submit('Cập nhật danh mục', ['class' => 'btn btn-success', 'id' => 'submit-button']) !!}



                            {!! Form::close() !!}
                            {{-- @endforeach --}}
                           
                            
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif


                        </div>
                    </div>
                </div>
            </div>

          
        </div>

        <div class="container">

        </div>


    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
      $(document).ready(function () {
          // Prevent form from submitting
          $("form").on("submit", function (event) {
              event.preventDefault();
          });
  
          // Show confirm dialog on submit button click
          $("#submit-button").on("click", function () {
              if (confirm("Bạn có đồng ý cập nhật thể loại phim không?")) {
                  $("form").unbind("submit").submit();
              }
          });
      });
  </script>

@endsection
