@extends('client.templates.layout')
@section('header')
    @include('client.components.header')
@endsection
@section('content')
    <div class="banner">
        <img class="w-100" src="{{ asset('img/banner-list-product.webp') }}" alt="">
    </div>
    <div class="product">
        <div class="row">
            <div class="col mt-4">
                {{-- <table class="table">
                    <thead class="bg-danger">
                    <tr>
                        <th class="text-white">KHOẢNG GIÁ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <input type="checkbox" name="" id="">
                            <span>Tất cả</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="" id="">
                            <span>Nhỏ hơn 100,000₫</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="" id="">
                            <span> Từ 100,000₫ - 200,000₫</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="" id="">
                            <span>Từ 200,000₫ - 300,000₫</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="" id="">
                            <span>Từ 300,000₫ - 400,000₫</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="" id="">
                            <span>Từ 400,000₫ - 500,000₫</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="" id="">
                            <span>Lớn hơn 500,000₫</span>
                        </td>
                    </tr>
                    </tbody>
                </table> --}}
                <div class="dropdown mt-3 mb-3">
                    <button class="btn btn-secondary dropdown-toggle btn-danger" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-border-width"></i> Lọc sản phẩm
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ url('/list-product') }}">Tất cả sản phẩm</a></li>
                        <li><a class="dropdown-item" href="{{ route('Route_Frontend_Product_filterProduct', ['price_min'=>0,'price_max'=>100000]) }}">Nhỏ hơn 100,000đ</a></li>
                        <li><a class="dropdown-item" href="{{ route('Route_Frontend_Product_filterProduct', ['price_min'=>100000,'price_max'=>200000]) }}">Từ 100,000 đến 200,000đ</a></li>
                        <li><a class="dropdown-item" href="{{ route('Route_Frontend_Product_filterProduct', ['price_min'=>200000,'price_max'=>300000]) }}">Từ 200,000 đến 300,000đ</a></li>
                        <li><a class="dropdown-item" href="{{ route('Route_Frontend_Product_filterProduct', ['price_min'=>300000,'price_max'=>400000]) }}">Từ 300,000 đến 400,000đ</a></li>
                        <li><a class="dropdown-item" href="{{ route('Route_Frontend_Product_filterProduct', ['price_min'=>400000,'price_max'=>500000]) }}">Từ 400,000 đến 500,000đ</a></li>
                        <li><a class="dropdown-item" href="{{ route('Route_Frontend_Product_filterProduct', ['price_min'=>500000,'price_max'=>99999999999]) }}">Lớn hơn 500,000đ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-9">
                <h2 class="mt-4 fs-3">TẤT CẢ SẢN PHẨM</h2>
                <div class="row mt-4">
                    @foreach($products as $product)
                    <div class="col-3 mt-4">
                        <a class="text-decoration-none" href="{{ route('route_Backend_Product_productDetail',['id'=>$product->id, 'id_category' =>$product->category_id]) }}">
                            <img id="mat_truoc_preview"
                                 src="{{ $product->image?''.Storage::url($product->image):'https://png.pngtree.com/element_our/20190531/ourlarge/pngtree-glowing-cartoon-box-image_1277152.jpg' }}"
                                 alt="your image"
                                 style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-responsive w-100"/>
                            <p class="text-body">{{ $product->name }}</p>
                            <span class="me-4 text-danger">
                            <?php
                                    $price = $product->price;
                                    $promotion = $product->promotion_price/100;
                                    $promotion_price = $price - ($price * $promotion);
                                    ?>
                                {{ formatPrice($promotion_price) }}
                            </span>
                            <span class="text-decoration-line-through ms-4 text-secondary">{{ formatPrice($product->price) }}</span>
                        </a>
                    </div>
                    @endforeach
            </div>
                <div class="position-relative mt-5">
                    <div class="position-absolute top-0 start-50 translate-middle">
                        {{ $products->appends($extParams)->links() }}
                    </div>
                </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('client.components.footer')
@endsection
