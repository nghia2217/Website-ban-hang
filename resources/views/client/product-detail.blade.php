@extends('client.templates.layout')
@section('header')
    @include('client.components.header')
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">

                    <img id="mat_truoc_preview"
                         src="{{ $objItem->image?''.Storage::url($objItem->image):'https://png.pngtree.com/element_our/20190531/ourlarge/pngtree-glowing-cartoon-box-image_1277152.jpg' }}"
                         alt="your image"
                         style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-responsive w-100 mb-3"/>
                    <img id="mat_truoc_preview"
                         src="{{ $objItem->image?''.Storage::url($objItem->image):'https://png.pngtree.com/element_our/20190531/ourlarge/pngtree-glowing-cartoon-box-image_1277152.jpg' }}"
                         alt="your image"
                         style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-responsive w-100 mb-3"/>
                    <img id="mat_truoc_preview"
                         src="{{ $objItem->image?''.Storage::url($objItem->image):'https://png.pngtree.com/element_our/20190531/ourlarge/pngtree-glowing-cartoon-box-image_1277152.jpg' }}"
                         alt="your image"
                         style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-responsive w-100 mb-3"/>
                </div>
                <div class="col-9">
                    <img id="mat_truoc_preview"
                         src="{{ $objItem->image?''.Storage::url($objItem->image):'https://png.pngtree.com/element_our/20190531/ourlarge/pngtree-glowing-cartoon-box-image_1277152.jpg' }}"
                         alt="your image"
                         style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-responsive w-100"/>
                </div>
            </div>

        </div>
        <div class="col-7">
            <h3 class="mb-4">{{ $objItem->name }}</h3>
            <div class="d-flex border-top border-bottom pt-2 pb-2">
                <span class="fs-4 me-4 text-danger">
                    <?php
                    $price = $objItem->price;
                    $promotion = $objItem->promotion_price/100;
                    $promotion_price = $price - ($price * $promotion);
                    ?>
                    {{ formatPrice($promotion_price) }}
                    </span>
                <span class="fs-4 text-decoration-line-through text-secondary">{{ formatPrice($objItem->price) }}</span>
            </div>
            <div class="row mt-4">
                <div class="col me-5">
                    <h5>Thông số</h5>
                    <p>{{ $objItem->description }}</p>
                </div>
                    <div class="col ms-4">
                        <form action="{{ route('Route_Frontend_Cart_Add') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h5 class="mb-4">Số lượng</h5>
                            <div class="d-flex mb-4">
                                <p class="btn btn-outline-danger border ps-3 pe-3 pt-1 pb-1"><i class="bi bi-dash-lg" onclick="reduce()"></i></p>
                                <!-- <input class="ps-3 pe-3 pt-1 pb-1" type="button" value=""> -->
                                <input class="w-25 text-center ms-2 me-2" type="number" id="quantity" name="quantity" value="1">
                                <p class="btn btn-outline-danger border ps-3 pe-3 pt-1 pb-1"><i class="bi bi-plus-lg" onclick="increase()"></i></p>
                            </div>
                            <input type="hidden" value="{{ $objItem->id }}" name="id">
                            <input type="hidden" value="{{ $objItem->name }}" name="name">
                            <input type="hidden" value="{{ $objItem->image }}" name="image">
                            <input type="hidden" value="{{ $promotion_price }}" name="price">
                            <input type="hidden" value="{{ $objItem->category_id }}" name="category_id">
                            <button class="btn btn-danger mb-2" type="submit">THÊM VÀO GIỎ HÀNG</button>
                            <br>
{{--                            <button class="btn btn-danger">MUA NGAY</button>--}}
                        </form>
                    </div>
            </div>
        </div>
    </div>
    <div>
        <img class="w-100 mt-5 mb-5" src="images/banner-p1.jpg" alt="">
    </div>
    <div class="comment border">
        <h2 class="bg-danger p-2 fs-5 text-white">BÌNH LUẬN</h2>
        <div class="list-comment ps-3 pe-5">
            <div class="row">
                <h3 class="fs-5">Nghĩa</h3>
                <p class="mb-0">Sản phẩm tốt!!</p>
                <p class="text-primary">Trả lời</p>
            </div>
            <div class="row">
                <h3 class="fs-5">Thảo</h3>
                <p class="mb-0">Sản phẩm tốt!!</p>
                <p class="text-primary">Trả lời</p>
            </div>
            <div class="row">
                <h3 class="fs-5">Mai</h3>
                <p class="mb-0">Sản phẩm tốt!!</p>
                <p class="text-primary">Trả lời</p>
            </div>

            <div class="input-group mb-3 ms-3 me-3">
                <input type="text" class="form-control w-25" placeholder="Viết bình luận..." aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-danger" type="button" id="button-addon2">Đăng</button>
            </div>
        </div>

    </div>

    <div class="">
        <h2 class="text-bold fs-1 text-center mt-4 mb-3">Sản phẩm cùng loại</h2>
        <div class="row">
            @foreach($products as $product)
                <div class="col-2">
                    <a class="text-decoration-none" href="{{ route('route_Backend_Product_productDetail',['id'=>$product->id, 'id_category' =>$product->category_id]) }}">
                        <img id="mat_truoc_preview"
                             src="{{ $product->image?''.Storage::url($product->image):'https://png.pngtree.com/element_our/20190531/ourlarge/pngtree-glowing-cartoon-box-image_1277152.jpg' }}"
                             alt="your image"
                             style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-responsive w-100"/>
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
    </div>

    <script>
        const reduce = () => {
            let result = document.querySelector('#quantity');
            let qty = result.value;
            if(!isNaN(qty)){
                result.value--;
                return false;
            }
        }

        const increase = () => {
            let result = document.querySelector('#quantity');
            let qty = result.value;
            if(!isNaN(qty)) {
                result.value++;
                return false;
            }
        }

    </script>
@endsection
@section('footer')
    @include('client.components.footer')
@endsection
