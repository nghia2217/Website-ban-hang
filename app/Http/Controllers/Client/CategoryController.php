<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function categoryDetail($id, Request $request) {
        $product = new Product();
        $category = new Category();
        $this->v['categories'] = $category->loadListWithPager();
        $this->v['products'] = $product->loadCategoryDetail($id);
        $this->v['category'] = $category->loadOne($id);
        $this->v['extParams'] = $request->all();
        return view('client.category-detail', $this->v);
    }
}
