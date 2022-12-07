@extends('client.templates.layout')
@section('header')
    @include('client.components.header')
@endsection
@section('content')
    @php
        $objUser = \Illuminate\Support\Facades\Auth::user();
    @endphp
    <div class="content">
        <div class="row" >
            <h2 class="mt-5">Thông tin tài khoản</h2>
            <div class="col mt-3">
                <p class="fs-5">Họ tên: {{ $objUser->name }}</p>
                <p class="fs-5">Email: {{ $objUser->email }}</p>
                <p class="fs-5">Số điện thoại: {{ $objUser->tel }}</p>
                <p class="fs-5">Địa chỉ: {{ $objUser->address }}</p>
                <a href="{{ route('Route_Frontend_User_ChangeInformation') }}">
                    <button class="btn btn-danger">Sửa thông tin</button>
                </a>
                <a href="{{ route('Route_Frontend_User_ChangePassword') }}">
                    <button class="btn btn-danger">Đổi mật khẩu</button>
                </a>
                <a href="{{ route('Route_Frontend_Bill_BillClient', ['user_id'=>$objUser->id]) }}">
                    <button class="btn btn-danger">Quản lý đơn hàng</button>
                </a>
            </div>
            <div class="col">
                <img width="150px" src="{{ $objUser->image?''.Storage::url($objUser->image):'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg' }}" alt="">
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('client.components.footer')
@endsection
