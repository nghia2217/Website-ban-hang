@extends('admin.templates.layout')
@section('title', $_title)
@section('content')
    <!-- Main content -->
    <section class="content appTuyenSinh">
        <link rel="stylesheet" href="{{ asset('default/bower_components/select2/dist/css/select2.min.css')}} ">
        <style>
            .select2-container--default .select2-selection--single, .select2-selection .select2-selection--single {
                padding: 3px 0px;
                height: 30px;
            }
            .select2-container {
                margin-top: -5px;
            }

            option {
                white-space: nowrap;
            }

            .select2-container--default .select2-selection--single {
                background-color: #fff;
                border: 1px solid #aaa;
                border-radius: 0px;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                color: #216992;
            }
            .select2-container--default .select2-selection--multiple{
                margin-top:10px;
                border-radius: 0;
            }
            .select2-container--default .select2-results__group{
                background-color: #eeeeee;
            }
        </style>

        <?php //Hiển thị thông báo thành công?>
        @if ( Session::has('success') )
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif
        <?php //Hiển thị thông báo lỗi?>
        @if ( Session::has('error') )
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif

        <!-- Phần nội dung riêng của action  -->
        <form class="form-horizontal " action="{{ route('route_Backend_Bill_Update',['id'=>request()->route('id')]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        {{-- <div class="form-group">
                            <label for="ten_de_thi" class="col-md-3 col-sm-4 control-label">Chọn vai trò <span class="text-danger">(*)</span></label>

                            <div class="col-md-9 col-sm-8">
                                <select class="form-select" aria-label="Default select example" name="id_user">
                                    <option>Chọn vai trò</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ ($user->id == $objItem->id_user) ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <span id="mes_sdt"></span>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label for="ten_de_thi" class="col-md-3 col-sm-4 control-label"> Tên khách hàng 
                                <span class="text-danger">(*):</span>
                            </label><span class="text-danger" style="font-size: 20px">{{ $objItem->user_name }}</span>
                            <br>
                            <label for="ten_de_thi" class="col-md-3 col-sm-4 control-label"> Tên Sản phẩm 
                                <span class="text-danger">(*):</span>
                            </label><span class="text-danger" style="font-size: 20px">{{ $objItem->product_name }}</span>
                            <br>
                            <label for="ten_de_thi" class="col-md-3 col-sm-4 control-label"> Hình ảnh
                                <span class="text-danger">(*):</span>
                            </label>
                            <img id="mat_truoc_preview"
                                         src="{{ ($objItem->product_image  == null) ? 'https://png.pngtree.com/element_our/20190531/ourlarge/pngtree-glowing-cartoon-box-image_1277152.jpg' : Storage::url($objItem->product_image) }}"
                                         alt="your image"
                                         style="max-width: 200px; height:100px; margin-bottom: 10px; margin-left: 50px;" class="img-responsive"/>
                                         <br>
                            <label for="ten_de_thi" class="col-md-3 col-sm-4 control-label"> Số lượng 
                                <span class="text-danger">(*):</span>
                            </label><span class="text-danger" style="font-size: 20px">{{ $objItem->quantity }}</span>
                            <br>
                            <label for="ten_de_thi" class="col-md-3 col-sm-4 control-label"> Tổng tiền
                                <span class="text-danger">(*):</span>
                                @php
                                    function formatPrice ($price) {
                                        $num = number_format($price,0, ',', '.').'đ';
                                        return $num;
                                    }
                                    @endphp
                                @php
                                    $promotion_price = $objItem->promotion_price/100;
                                    $product_price = $objItem->product_price;
                                    $price = $product_price - ($product_price * $promotion_price);
                                    $quantity = $objItem->quantity;
                                @endphp

                            </label><span class="text-danger" style="font-size: 20px">{{ formatPrice($price * $quantity) }}</span>
                            <br>
                            <label for="ten_de_thi" class="col-md-3 col-sm-4 control-label"> Số điện thoại 
                                <span class="text-danger">(*):</span>
                            </label><span class="text-danger" style="font-size: 20px">{{ $objItem->tel }}</span>
                            <br>
                            <label for="ten_de_thi" class="col-md-3 col-sm-4 control-label"> Địa chỉ 
                                <span class="text-danger">(*):</span>
                            </label><span class="text-danger" style="font-size: 20px">{{ $objItem->address }}</span>
                            <br>

                            <div class="form-group">
                                <label for="ten_de_thi" class="col-md-3 col-sm-4 control-label">Trạng thái <span class="text-danger">(*)</span></label>
    
                                <div class="col-md-9 col-sm-8">
                                    <select class="form-select" aria-label="Default select example" name="status">
                                        @if ($objItem->status == 1)
                                            <option value="1" selected>Đang xử lý</option>
                                            <option value="2">Đang giao hàng</option>
                                            <option value="3">Giao hàng thành công</option>
                                            <option value="4">Giao hàng thất bại</option>
                                        @elseif ($objItem->status == 2)
                                            <option value="1">Đang xử lý</option>
                                            <option value="2" selected>Đang giao hàng</option>
                                            <option value="3">Giao hàng thành công</option>
                                            <option value="4">Giao hàng thất bại</option>
                                        @elseif ($objItem->status == 3)
                                            <option value="1">Đang xử lý</option>
                                            <option value="2">Đang giao hàng</option>
                                            <option value="3" selected>Giao hàng thành công</option>
                                            <option value="4">Giao hàng thất bại</option>
                                        @elseif ($objItem->status == 4)
                                            <option value="1">Đang xử lý</option>
                                            <option value="2">Đang giao hàng</option>
                                            <option value="3">Giao hàng thành công</option>
                                            <option value="4"selected>Giao hàng thất bại</option>
                                        @endif
                                    </select>
                                    <span id="mes_sdt"></span>
                                </div>
                            </div>
                            {{-- <div class="col-md-9 col-sm-8">
                                <input type="text" name="name" id="name" class="form-control" value="{{ $objItem->user_name }}">
                                <span id="mes_sdt"></span>
                            </div> --}}
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary"> Save</button>
                <a href="{{ route('route_Backed_Bill_Bill') }}" class="btn btn-default">Cancel</a>
            </div>
            <!-- /.box-footer -->
        </form>

    </section>
@endsection
@section('script')
    <script src="{{ asset('default/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('default/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
@endsection

