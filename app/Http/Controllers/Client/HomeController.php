<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function home(Request $request) {
        $product = new Product();
        $category = new Category();
        $banner = new Banner();
        $this->v['products'] = $product->loadListHomeClient();
        $this->v['categories'] = $category->loadListWithPager();
        $this->v['banners'] = $banner->loadListWithPager();
        $this->v['extParams'] = $request->all();
        return view('client.home', $this->v);
    }
}
