@extends('client.templates.layout')
@section('content')
    <div class="container w-50">
        <div class="logo">
            <img class="rouned mx-auto d-block mb-5 mt-5" src="{{ asset('img/logo.webp') }}" alt="">
        </div>
        <h3>Xin chào</h3>
        <p><a class="text-decoration-none text-danger" href="{{ url('/login') }}">Đăng nhập</a> hoặc <a class="text-decoration-none text-danger" href="{{ url('/register') }}">Tạo tài khoản</a></p>
        <?php //Hiển thị thông báo thành công?>
        @if ( Session::has('success') )
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
            </div>
        @endif
        <?php //Hiển thị thông báo lỗi?>
        @if ( Session::has('error') )
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong>{{ Session::get('error') }}</strong>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Họ tên</label>
                <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
            </div>
            <input type="text" class="form-control" name="id_role" id="exampleInputPassword1" value="1" hidden>
            <input type="text" class="form-control" name="status" id="exampleInputPassword1" value="1" hidden>
            <div class="text-end">
                <button type="submit" class="btn btn-danger w-100 mt-3" style="margin-bottom: 300px;">Đăng ký</button>
            </div>

        </form>
    </div>
@endsection
