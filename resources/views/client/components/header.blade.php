@php
    $objUser = \Illuminate\Support\Facades\Auth::user();
@endphp
@php
function formatPrice ($price) {
    $num = number_format($price,0, ',', '.').'đ';
    return $num;
}
@endphp
<header>
    <nav class="bg-light position-relative">
        <div class="header d-flex">
            <form class="d-flex align-self-center ms-4" role="search" action="{{ route('Route_Frontend_Product_Search') }}" method="POST">
                @csrf
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn border-danger" type="submit"><i class="bi bi-search text-danger"></i></button>
            </form>
            <a href="{{ url('/') }}"><img class="pt-4 pb-4" style="margin-left: 350px;" src="{{ asset('img/logo.webp') }}" alt=""></a>
            @if($objUser)
                <div class="icon align-self-center position-absolute end-0 me-4">
                    <a class="login text-dark text-decoration-none me-3" href="{{ route('Route_Frontend_User_Detail') }}"><i class="bi bi-person-circle"> {{ $objUser->name }}</i></a>
                    <a class="register text-dark text-decoration-none me-3" href="{{ url('/logout') }}"><i class="bi bi-box-arrow-right"> Đăng xuất</i></a>
                    <a class="cart text-dark text-decoration-none" href="{{ route('Route_Frontend_Cart_List') }}"><i class="bi bi-bag-check-fill"></i>
                        <span class="text-white bg-danger rounded-circle" style="padding-left: 6px; padding-right: 6px">{{ Cart::getTotalQuantity()}}</a></span>
                    </a>

                </div>
            @else
                <div class="icon align-self-center position-absolute end-0 me-4">
                    <a class="login text-dark text-decoration-none me-3" href="{{ url('/login') }}"><i class="bi bi-box-arrow-in-right"> Đăng nhập</i></a>
                    <a class="register text-dark text-decoration-none me-3" href="{{ url('/register') }}"><i class="bi bi-person-plus-fill"> Đăng ký</i></a>
                    <a class="cart text-dark text-decoration-none" href="{{ route('Route_Frontend_Cart_List') }}"><i class="bi bi-bag-check-fill"></i>
                        <span class="text-white bg-danger rounded-circle" style="padding-left: 6px; padding-right: 6px">{{ Cart::getTotalQuantity()}}</a></span>

                </div>
            @endif
        </div>
    </nav>
</header>
<div class="dropdown mt-3 mb-3">
    <button class="btn btn-secondary dropdown-toggle btn-danger" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-border-width"></i> Danh mục sản phẩm
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="{{ url('/list-product') }}">Tất cả sản phẩm</a></li>
        @foreach($categories as $category)
        <li><a class="dropdown-item" href="{{ route('route_Backend_Category_categoryDetail',['id'=>$category->id]) }}">{{ $category->name }}</a></li>
        @endforeach
    </ul>
</div>
