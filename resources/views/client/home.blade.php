@extends('client.templates.layout')
@section('header')
    @include('client.components.header')
@endsection
@section('banner')
    @include('client.components.banner')
@endsection
@section('content')
    <h2 class="text-center mt-5 mb-3">SẢN PHẨM MỚI</h2>
    <div class="row">
        @foreach($products as $product)
            <div class="col-2">
                <a class="text-decoration-none" href="{{ route('route_Backend_Product_productDetail',['id'=>$product->id, 'id_category' =>$product->category_id]) }}">
                    <img id="mat_truoc_preview"
                         src="{{ $product->image?''.Storage::url($product->image):'https://png.pngtree.com/element_our/20190531/ourlarge/pngtree-glowing-cartoon-box-image_1277152.jpg' }}"
                         alt="your image"
                         style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-responsive"/>
                    <p class="text-body">{{ $product->name }}</p>
                    <span class="me-5 text-danger">
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

    <img class="w-100 mt-5" src="{{ asset('img/banner-list-product.webp') }}" alt="">

    <h2 class="text-center mt-5 mb-3">SẢN PHẨM BÁN CHẠY</h2>

    <div class="row">
        @foreach($products as $product)
            <div class="col-2">
                <a class="text-decoration-none" href="{{ route('route_Backend_Product_productDetail',['id'=>$product->id, 'id_category' =>$product->category_id]) }}">
                    <img id="mat_truoc_preview"
                         src="{{ $product->image?''.Storage::url($product->image):'https://png.pngtree.com/element_our/20190531/ourlarge/pngtree-glowing-cartoon-box-image_1277152.jpg' }}"
                         alt="your image"
                         style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-responsive"/>
                    <p class="text-body">{{ $product->name }}</p>
                    <span class="me-5 text-danger">
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

    <img class="w-100 mt-5" src="{{ asset('img/banner-p2.jpg') }}" alt="">

    <h2 class="text-center mt-5 mb-3">TỐT NHẤT CỦA HÃNG</h2>

    <div class="row">
        @foreach($products as $product)
            <div class="col-2">
                <a class="text-decoration-none" href="{{ route('route_Backend_Product_productDetail',['id'=>$product->id, 'id_category' =>$product->category_id]) }}">
                    <img id="mat_truoc_preview"
                         src="{{ $product->image?''.Storage::url($product->image):'https://png.pngtree.com/element_our/20190531/ourlarge/pngtree-glowing-cartoon-box-image_1277152.jpg' }}"
                         alt="your image"
                         style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-responsive"/>
                    <p class="text-body">{{ $product->name }}</p>
                    <span class="me-5 text-danger">
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
@endsection
@section('footer')
    @include('client.components.footer')
@endsection
