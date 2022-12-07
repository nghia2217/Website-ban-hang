@extends('client.templates.layout')
@section('content')
    @php
        $objUser = \Illuminate\Support\Facades\Auth::user();
    @endphp
    <div class="container w-50">
        <div class="logo">
            <a href="{{ route('Route_Frontend_Home') }}">
                <img class="rouned mx-auto d-block mb-5 mt-5" src="{{ asset('img/logo.webp') }}" alt="">
            </a>
        </div>
        <h3>Thay đổi thông tin</h3>
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
        <form action="{{ route('Route_Frontend_User_UpdateInformation',['id'=>$objUser->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label me-4">Hình ảnh</label>
                <img id="mat_truoc_preview" class="img-responsive" width="150px" src="{{ $objUser->image?''.Storage::url($objUser->image):'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg' }}" alt="">
                <input id="cmt_truoc" type="file" class="form-control mt-4" name="image" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Họ tên</label>
                <input type="text" accept="image/*" class="form-control" name="name" value="{{ $objUser->name }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" name="tel" value="{{ $objUser->tel }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" name="address" value="{{ $objUser->address }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-danger w-100 mt-3" style="margin-bottom: 300px;">Đổi thông tin</button>
            </div>

        </form>
    </div>


@endsection
