<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ListProductController extends Controller
{
    //
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function listProduct(Request $request) {
        $product = new Product();
        $category = new Category();
        $this->v['products'] = $product->loadListWithPager();
        $this->v['categories'] = $category->loadListWithPager();
        $this->v['extParams'] = $request->all();
        return view('client.list-product', $this->v);
    }

    public function productDetail($id, $id_category, Request $request) {
        $category = new Category();
        $product = new Product();
        $this->v['categories'] = $category->loadListWithPager();
        $this->v['products'] = $product->loadProductCategory($id_category);
        $objItem = $product->loadOne($id);
        $this->v['objItem'] = $objItem;
        return view('client.product-detail', $this->v);
    }

    public function search(Request $request) {
        $category = new Category();
        $product = new Product();
        $this->v['categories'] = $category->loadListWithPager();
        $this->v['extParams'] = $request->all();
        $name = $request->search;
        $this->v['products'] = $product->loadListSearchProduct($name);
        $this->v['nameSearch'] = $name;
        return view('client.search-products', $this->v);
    }


    public function filterProduct ($price_min, $price_max, Request $request) {
        $category = new Category();
        $product = new Product();

        $this->v['categories'] = $category->loadListWithPager();
        $this->v['products'] = $product->loadFilterProduct($price_min, $price_max);
        $this->v['extParams'] = $request->all();

        return view('client.filter-products', $this->v);
    }

}
