<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function list(Request $request) {
        $category = new Category();
        $this->v['categories'] = $category->loadListWithPager();
        $this->v['carts'] = \Cart::getContent();
//        dd($this->v['carts']);
        return view('client.cart', $this->v);
    }

    public function add(Request $request) {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
                'category_id' => $request->category_id
            )
        ]);

        session()->flash('susscess', 'Sản phẩm được thêm vào giỏ hàng thành công!');

        return redirect()->route('Route_Frontend_Cart_List');
    }

    public function update(Request $request) {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );
        session()->flash('success', 'Giỏ hàng đã được cập nhật thành công');
        return redirect()->route('Route_Frontend_Cart_List');
    }

    public function remove(Request $request) {
        \Cart::remove($request->id);
        session()->flash('success','Sản phẩm đã được xóa khỏi giỏ hàng thành công');
        return redirect()->route('Route_Frontend_Cart_List');
    }

    public function clear() {
        \Cart::clear();
        session()->flash('success','Xóa tất cả giỏ hàng thành công!');
        return redirect()->route('Route_Frontend_Cart_List');
    }

}
