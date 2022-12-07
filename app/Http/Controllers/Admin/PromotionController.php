<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionRequest;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PromotionController extends Controller
{
    //
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function promotion(Request $request) {
        $promotion = new Promotion();
        $this->v['promotions'] = $promotion->loadListWithPager();
        $this->v['extParams'] = $request->all();
        return view('admin.promotions.list-promotion', $this->v);
    }

    public function addPromotion(PromotionRequest $request) {
        $method_route = 'router_BackEnd_AddPromotion_index';
        $this->v['_title'] = "Thêm khuyễn mãi";
        if ($request->isMethod('post')) {
            //dd($request->post());//dong data post gui sang
            $params = [];
            $params['cols'] = $request->post();
            unset( $params['cols']['_token']);
            $modelPromotion = new Promotion();
            $res = $modelPromotion->saveNew($params);
            if ($res == null) {
                return redirect()->route($method_route);
            } elseif ($res>0) {
                Session::flash('success','Thêm mới khuyễn mãi thành công');
            } else {
                Session::flash('error', 'Lỗi khi thêm mới khuyễn mãi');
            }
        }
        return view('admin.promotions.add-promotion', $this->v);
    }

    public function detail($id, Request $request) {
        $this->v['_title'] = "Chi tiết người dùng";
        $promotion = new Promotion();
        $objItem = $promotion->loadOne($id);
        $this->v['objItem'] = $objItem;
        return view('admin.promotions.detail', $this->v);
    }

    public function update($id, PromotionRequest $request) {
        $method_route = 'route_Backend_Promotion_Detail';
        $params = [];
        $params['cols'] = $request->post();
        unset( $params['cols']['_token']);
        $params['cols']['id'] = $id;
        $promotion = new Promotion();
        $res = $promotion->saveUpdate($params);
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
        $promotion = new Promotion();
        $promotion->deleteOne($id);
        $this->v['promotions'] = $promotion->loadListWithPager();
        $this->v['extParams'] = $request->all();
        return view('admin.promotions.list-promotion', $this->v);
    }
}
