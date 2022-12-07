<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BillController extends Controller
{
    //
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function bill(Request $request) {
        $bill = new Bill();
        $this->v['bills'] = $bill->loadListWithPager();
        $this->v['extParams'] = $request->all();
        return view('admin.bills.list-bill', $this->v);
    }

    public function detail($id, Request $request) {
        $this->v['_title'] = "Chi tiết người dùng";
        $bill = new Bill();
        $user = new User();
        $objItem = $bill->loadOne($id);
        $this->v['objItem'] = $objItem;
        $this->v['users'] = $user->loadListWithPager();
        return view('admin.bills.detail', $this->v);
    }

    public function update($id, Request $request) {
        $method_route = 'route_Backend_Bill_Detail';
        $params = [];
        $params['cols'] = $request->post();
        unset( $params['cols']['_token']);
        $params['cols']['id'] = $id;
        $bill = new Bill();
        $res = $bill->saveUpdate($params);
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

    public function delete($id, Request $request) {
        $bill = new Bill();
        $bill->deleteOne($id);
        $this->v['bills'] = $bill->loadListWithPager();
        $this->v['extParams'] = $request->all();
        return view('admin.bills.list-bill', $this->v);
    }

    public function billClient($user_id, Request $request) {
        $bill = new Bill();
        $category = new Category();
        $this->v['bills'] = $bill->loadBillClient($user_id);
        $this->v['categories'] = $category->loadListWithPager();
        $this->v['extParams'] = $request->all();
        return view('client.bill-client', $this->v);
    }

    public function billClientDelete($id, $user_id, Request $request) {
        $bill = new Bill();
        $category = new Category();
        $bill::destroy($id);
        $this->v['bills'] = $bill->loadBillClient($user_id);
        $this->v['categories'] = $category->loadListWithPager();
        $this->v['extParams'] = $request->all();
        return view('client.bill-client', $this->v);
    }
}
