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
        <h2 class="fs-4 mt-3">QUẢN LÝ ĐƠN HÀNG</h2>

        <table class="table">
            <thead>
            <tr>
                <th class="text-center col" scope="col-3">Tên sản phẩm</th>
                <th class="text-center col" scope="col-3">Hình ảnh</th>
                <th class="text-center col" scope="col-3">Số lượng</th>
                <th class="text-center col" scope="col-3">Tổng tiền</th>
                <th class="text-center col" scope="col-3">Trạng thái</th>
                <th class="text-center col" scope="col-3">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bills as $bill)
                {{-- <tr>
                    <td>
                        <div class="row-2">
                            <div class="col-2">
                                <a href="{{ route('route_Backend_Product_productDetail',['id'=>$bill->id, 'id_category' =>$bill->category_id]) }}">
                                    <img class="" width="100" src="{{ $bill->product_image?''.Storage::url($bill->product_image):'https://png.pngtree.com/element_our/20190531/ourlarge/pngtree-glowing-cartoon-box-image_1277152.jpg' }}" alt="">
                                </a>
                            </div>
                            <div class="col-2">
                                <a href="{{ route('route_Backend_Product_productDetail',['id'=>$bill->id, 'id_category' =>$bill->category_id]) }}" class="text-decoration-none">
                                    <p class="mt-4 fw-bold fs-5 text-danger">{{ $bill->product_name }}</p>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td><p class="mt-4 fw-bold" style="font-size: 18px">{{ formatPrice($bill->product_price) }}</p></td>
                    <td>
    
                    </td>
                    @php
                    $price = $bill->product_price;
                    $quantity = $bill->quantity;
                    $total_price = $price * $quantity;
                    @endphp
                    <td><p class="mt-4 fw-bold" style="font-size: 18px">{{ formatPrice($total_price) }}</p></td>
                </tr> --}}
                <tr>
                    <td class="text-center col"><p class="mt-4 fw-bold" style="font-size: 18px">{{ $bill->product_name }}</p></td>
                    <td class="text-center col">
                        <img class="" width="100" src="{{ $bill->product_image?''.Storage::url($bill->product_image):'https://png.pngtree.com/element_our/20190531/ourlarge/pngtree-glowing-cartoon-box-image_1277152.jpg' }}" alt="">
                    </td>
                    <td class="text-center col"><p class="mt-4 fw-bold" style="font-size: 18px">{{ $bill->quantity }}</p></td>
                    @php
                        $promotion_price = $bill->promotion_price/100;
                        $product_price = $bill->product_price;
                        $price = $product_price - ($product_price * $promotion_price);
                        $quantity = $bill->quantity;
                        $total_price = $price * $quantity;
                    @endphp
                    <td class="text-center col"><p class="mt-4 fw-bold" style="font-size: 18px">{{ formatPrice($total_price) }}</p></td>
                    @if ($bill->status == 1)
                        <td class="text-center col"><p class="mt-4 fw-bold" style="font-size: 18px">Đang xử lý</p></td>
                    @elseif ($bill->status == 2)
                        <td class="text-center col"><p class="mt-4 fw-bold" style="font-size: 18px">Đang giao hàng</p></td>
                    @elseif ($bill->status == 3)
                        <td class="text-center col"><p class="mt-4 fw-bold" style="font-size: 18px">Giao hàng thành công</p></td>
                    @elseif ($bill->status == 4)
                        <td class="text-center col"><p class="mt-4 fw-bold" style="font-size: 18px">Giao hàng thất bại</p></td>
                    @endif
                    <td class="text-center col">
                        @if ($bill->status == 1)
                            <a href="{{ route('Route_Frontend_Bill_BillClientDelete', ['id'=>$bill->id, 'user_id'=>$bill->id_user]) }}"
                                onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng?')">
                                <button class="btn btn-danger">Hủy đơn hàng</button>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('footer')
    @include('client.components.footer')
@endsection
