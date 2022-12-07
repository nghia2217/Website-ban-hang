@extends('client.templates.layout')
@section('content')
    <div class="container w-50">
        <a href="{{ route('Route_Frontend_Home') }}">
            <div class="logo">
                <img class="rouned mx-auto d-block mb-5 mt-5" src="{{ asset('img/logo.webp') }}" alt="">
            </div>
        </a>

        <h3>Đổi mật khẩu</h3>
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
        <form action="{{ route('Route_Frontend_User_UpdatePassword') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Mật khẩu cũ</label>
                <input type="password" class="form-control" name="old_password" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Mật khẩu mới</label>
                <input type="password" class="form-control" name="new_password" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nhập lại mật khẩu mới</label>
                <input type="password" class="form-control" name="new_password_confirmation" id="exampleInputPassword1">
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-danger w-100 mt-3" style="margin-bottom: 300px;">Đổi mật khẩu</button>
            </div>

        </form>
    </div>
@endsection
