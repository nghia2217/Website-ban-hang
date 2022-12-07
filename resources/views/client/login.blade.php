@extends('client.templates.layout')
@section('content')
    @if(Auth::user())
        <script>window.location.href='/';</script>
    @endif
    <div class="container w-50">
        <div class="logo">
            <img class="rouned mx-auto d-block mb-5 mt-5" src="{{ asset('img/logo.webp') }}" alt="">
        </div>
        <h3>Xin chào</h3>
        <p><a class="text-decoration-none text-danger" href="{{ url('/login') }}">Đăng nhập</a> hoặc <a class="text-decoration-none text-danger" href="{{ url('/register') }}">Tạo tài khoản</a></p>
        <form action="{{ url('/login') }}" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-danger w-100 mt-3 mb-4">Đăng nhập</button>
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
        </form>

        <?php //Hiển thị thông báo thành công?>
        @if ( Session::has('success') )
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
{{--                <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span>--}}
{{--                    <span class="sr-only">Close</span>--}}
{{--                </button>--}}
            </div>
        @endif
        <?php //Hiển thị thông báo lỗi?>
        @if ( Session::has('error') )
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong>{{ Session::get('error') }}</strong>
{{--                <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span>--}}
{{--                    <span class="sr-only">Close</span>--}}
{{--                </button>--}}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
{{--                <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span>--}}
{{--                    <span class="sr-only">Close</span>--}}
{{--                </button>--}}
            </div>
        @endif
    </div>
@endsection

