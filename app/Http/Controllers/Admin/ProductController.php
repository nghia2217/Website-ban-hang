<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    //
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function product(Request $request) {
        $product = new Product();
        $this->v['products'] = $product->loadListWithPager();
        $this->v['extParams'] = $request->all();
        return view('admin.products.list-product', $this->v);
    }

    public function addProduct(ProductRequest $request) {
        $modelCategory = new Category();
        $modelPromotion = new Promotion();
        $this->v['categories'] = $modelCategory->loadListWithPager();
        $this->v['promotions'] = $modelPromotion->loadListWithPager();
        $method_route = 'router_BackEnd_AddProduct_index';
        $this->v['_title'] = "Thêm sản phẩm";
        if ($request->isMethod('post')) {
            //dd($request->post());//dong data post gui sang
            $params = [];
            $params['cols'] = $request->post();
            unset( $params['cols']['_token']);
            if ($request->hasFile('image') && $request->file('image')->isValid())
            {
                $params['cols']['image'] = $this->uploadFile($request->file('image'));
            }
            $modelProduct = new Product();
            $res = $modelProduct->saveNew($params);
            if ($res == null) {
                return redirect()->route($method_route);
            } elseif ($res>0) {
                Session::flash('success','Thêm mới sản phẩm thành công');
            } else {
                Session::flash('error', 'Lỗi khi thêm mới sản phẩm');
            }
        }
        return view('admin.products.add-product', $this->v);
    }

    public function detail($id, Request $request) {
        $this->v['_title'] = "Chi tiết sản phẩm";
        $product = new Product();
        $category = new Category();
        $promotion = new Promotion();
        $objItem = $product->loadOne($id);
        $this->v['objItem'] = $objItem;
        $this->v['categories'] = $category->loadListWithPager();
        $this->v['promotions'] = $promotion->loadListWithPager();
        return view('admin.products.detail', $this->v);
    }

    public function update($id, ProductRequest $request) {
        $method_route = 'route_Backend_Product_Detail';
        $params = [];
        $params['cols'] = $request->post();
        unset( $params['cols']['_token']);
        if ($request->hasFile('image') && $request->file('image')->isValid())
        {
            $params['cols']['image'] = $this->uploadFile($request->file('image'));
        }
        $params['cols']['id'] = $id;
        $product = new Product();
        $res = $product->saveUpdate($params);
        if ($res == null) {
            return redirect()->route($method_route, ['id'=>$id]);
        } elseif ($res == 1) {
            Session::flash('success', 'Cập nhật bản ghi '.$id.' thành công');
            return redirect()->route($method_route, ['id'=>$id]);
        } else {
            Session::flash('error', 'Lỗi cập nhật bản ghi '.$id);
            return redirect()->route($method_route, ['id'=>$id]);
        }
    }

    public function uploadFile($file) {
        $fileName = time().'_'.$file->getClientOriginalName();
        return $file->storeAs('image_products',$fileName,'public');
    }

    public function delete($id, Request $request) {
        $product = new Product();
        $product->deleteOne($id);
        $this->v['products'] = $product->loadListWithPager();
        $this->v['extParams'] = $request->all();
        return view('admin.products.list-product', $this->v);
    }
}
