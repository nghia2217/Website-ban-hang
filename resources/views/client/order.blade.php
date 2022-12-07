@extends('client.templates.layout')
@section('content')
    @php
        $objUser = \Illuminate\Support\Facades\Auth::user();
    @endphp
    @php
        function formatPrice ($price) {
            $num = number_format($price,0, ',', '.').'đ';
            return $num;
        }
    @endphp
    <div class="row">
        <div class="col-7 border-end">
            <h2 class="mt-5">Nhà xuất bản Đại Nghĩa</h2>
            <p>Thông tin thanh toán</p>
                <div class="input-group mb-3">
                    <form class="w-100" action="" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Họ và tên: {{ $objUser->name }}</label>
                        </div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Email: {{ $objUser->email }}</label>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" name="tel" id="exampleInputPassword1">
                            </div>

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        @foreach($carts as $cart)
                        <input type="hidden" name="id_user" value="{{$objUser->id}}">
                        
                            <input type="hidden" name="id_product" value="{{$cart->id}}">
                            <input type="hidden" name="quantity" value="{{$cart->quantity}}">
                    @endforeach
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Thanh Toán</button>
                        </div>

                    </form>
                </div>

        </div>
        <div class="col bg-light pt-5">
            @foreach($carts as $cart)
                <div class="row mb-3">
                    <div class="col-2">
                        <img class="w-100" src="{{ $cart->attributes->image?''.Storage::url($cart->attributes->image):'https://png.pngtree.com/element_our/20190531/ourlarge/pngtree-glowing-cartoon-box-image_1277152.jpg' }}" alt="">
                    </div>
                    <div class="col-3">
                        <p class="mt-2">{{ $cart->name }}</p>
                    </div>
                    <div class="col-3" style="margin-left: 10px">
                        <p class="mt-3">{{ $cart->quantity }}</p>
                    </div>
                    <div class="col">
                        @php
                            $price = $cart->price;
                            $quantity = $cart->quantity;
                            $total_price = $price * $quantity;
                        @endphp
                        <p class="mt-3">{{ formatPrice($total_price) }}</p>
                    </div>
                </div>
            @endforeach
            <div class="mt-3 border-top pt-3 border-bottom pb-3">
                <div>
                    <span>Tạm tính </span>
                    <span style="margin-left: 300px;">{{ formatPrice(Cart::getTotal()) }}</span>
                </div>
                <div class="mt-1">
                    <span>Phí ship </span>
                    <span style="margin-left: 327px;">20.000₫</span>
                </div>
            </div>
            <div class="mt-3 pb-5">
                <span>Tổng tiền</span>
                @php
                    $total = Cart::getTotal();
                    $end_total_price = $total + 20000;
                @endphp
                <span class="fs-3" style="margin-left: 260px;">{{ formatPrice($end_total_price) }}</span>
            </div>
        </div>
    </div>
@endsection
