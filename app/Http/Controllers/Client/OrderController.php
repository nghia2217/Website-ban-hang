<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Bill;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    //
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function list(Request $request) {
        $this->v['carts'] = \Cart::getContent();
        return view('client.order', $this->v);
    }

    public function add(Request $request) {
        $category = new Category();
        $banner = new Banner();
        $product = new Product();
        $this->v['categories'] = $category->loadListWithPager();
        $this->v['banners'] = $banner->loadListWithPager();
        $this->v['products'] = $product->loadListHomeClient();
        $this->v['extParams'] = $request->all();
        $method_route = 'Route_Frontend_Order_Add';
        if ($request->isMethod('post')) {
            //dd($request->post());//dong data post gui sang
            $params = [];
            $params['cols'] = $request->post();
            unset( $params['cols']['_token']);
            $bill = new Bill();
            // dd($params);
            $res = $bill->saveNew($params);
            if ($res == null) {
                return redirect()->route($method_route);
            } elseif ($res>0) {
                \Cart::remove($request->id_product);
                Session::flash('success','Thêm mới sản phẩm thành công');
            } else {
                Session::flash('error', 'Lỗi khi thêm mới sản phẩm');
            }
        }
        return view('client.home', $this->v);
    }
}
