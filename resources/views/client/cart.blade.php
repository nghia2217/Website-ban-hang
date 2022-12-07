@extends('client.templates.layout')
@section('header')
    @include('client.components.header')
@endsection
@section('content')
    @php
        $objUser = \Illuminate\Support\Facades\Auth::user();
    @endphp
    <div class="banner">
        <img class="w-100" src="images/banner-list-product.webp" alt="">
    </div>
    @if ($message = Session::get('success'))
        <div class="p-2 mb-2 bg-danger">
            <p class="text-white pt-3" style="font-size: 15px"><i class="bi bi-bell-fill me-2"></i>{{ $message }}</p>
        </div>
    @endif
    <div class="cart">
        <h2 class="fs-4 mt-3">GIỎ HÀNG</h2>

        <table class="table">
            <thead>
            <tr>
                <th class="text-center col-8" scope="col-3">Sản phẩm</th>
                <th class="text-center col-1" scope="col-3">Đơn giá</th>
                <th class="text-center col-3" scope="col-3">Số lượng</th>
                <th class="text-center col-1" scope="col-3">Tổng giá</th>
            </tr>
            </thead>
            <tbody>
            @foreach($carts as $cart)
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-2">
                                <a href="{{ route('route_Backend_Product_productDetail',['id'=>$cart->id, 'id_category' =>$cart->attributes->category_id]) }}">
                                    <img class="w-100" src="{{ $cart->attributes->image?''.Storage::url($cart->attributes->image):'https://png.pngtree.com/element_our/20190531/ourlarge/pngtree-glowing-cartoon-box-image_1277152.jpg' }}" alt="">
                                </a>
                            </div>
                            <div class="col-9">
                                <a href="{{ route('route_Backend_Product_productDetail',['id'=>$cart->id, 'id_category' =>$cart->attributes->category_id]) }}" class="text-decoration-none">
                                    <p class="mt-4 fw-bold fs-5 text-danger">{{ $cart->name }}</p>
                                </a>
                                <form action="{{ route('Route_Frontend_Cart_Remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$cart->id}}" name="id">
                                    <button class="btn btn-btn-white text-danger">Xóa</button>
                                </form>

                            </div>
                        </div>
                    </td>
                    <td><p class="mt-4 fw-bold" style="font-size: 18px">{{ formatPrice($cart->price) }}</p></td>
                    <td>
                        <div class="d-flex mb-4" style="margin-top: 30px; margin-left: 57px;">
                            <!-- <input class="ps-3 pe-3 pt-1 pb-1" type="button" value=""> -->
                            <form action="{{ route('Route_Frontend_Cart_Update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $cart->id }}">
                                <input class="w-25 text-center ms-5 me-2 ps-3 pe-2" style="height: 40px;" type="number" id="quantity1" name="quantity" value="{{ $cart->quantity }}">
                                <button class="btn btn-danger"><i class="bi bi-arrow-clockwise"></i></button>
                            </form>
                        </div>
                    </td>
                    @php
                    $price = $cart->price;
                    $quantity = $cart->quantity;
                    $total_price = $price * $quantity;
                    @endphp
                    <td><p class="mt-4 fw-bold" style="font-size: 18px">{{ formatPrice($total_price) }}</p></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            <form action="{{ route('Route_Frontend_Cart_Clear') }}" method="POST">
                @csrf
                <button class="btn btn-danger mt-2">Xóa tất cả</button>
            </form>
        </div>
        <div class="text-end">
            <span class="fs-5">Tổng: </span><span class="fs-3 fw-bold ms-3">{{ formatPrice(Cart::getTotal()) }}</span>
            <br>
            @if ($objUser)
                <a href="{{ route('Route_Frontend_Order_List') }}">
                    <button class="btn btn-danger mt-1">THANH TOÁN</button>
                </a>
            @else
                <button class="btn btn-primary mt-1">VUI LÒNG ĐĂNG NHẬP ĐỂ THANH TOÁN</button>
            @endif
        </div>
    </div>
@endsection
@section('footer')
    @include('client.components.footer')
@endsection
