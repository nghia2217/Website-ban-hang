<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerResquest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BannerController extends Controller
{
    //
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function banner(Request $request) {
        $banner = new Banner();
        $this->v['banners'] = $banner->loadListWithPager();
        $this->v['extParams'] = $request->all();
        return view('admin.banners.list-banner', $this->v);
    }

    public function addBanner(BannerResquest $request) {
        $method_route = 'router_BackEnd_AddBanner_index';
        $this->v['_title'] = "Thêm banner";
        if ($request->isMethod('post')) {
            //dd($request->post());//dong data post gui sang
            $params = [];
            $params['cols'] = $request->post();
            unset( $params['cols']['_token']);
            if ($request->hasFile('image') && $request->file('image')->isValid())
            {
                $params['cols']['image'] = $this->uploadFile($request->file('image'));
            }
            $modelBanner = new Banner();
            $res = $modelBanner->saveNew($params);
            if ($res == null) {
                return redirect()->route($method_route);
            } elseif ($res>0) {
                Session::flash('success','Thêm mới banner thành công');
            } else {
                Session::flash('error', 'Lỗi khi thêm mới banner');
            }
        }
        return view('admin.banners.add-banner', $this->v);
    }

    public function detail($id, Request $request) {
        $this->v['_title'] = "Chi tiết banner";
        $banner = new Banner();
        $objItem = $banner->loadOne($id);
        $this->v['objItem'] = $objItem;
        return view('admin.banners.detail', $this->v);
    }

    public function update($id, BannerResquest $request) {
        $method_route = 'route_Backend_Banner_Detail';
        $params = [];
        $params['cols'] = $request->post();
        unset( $params['cols']['_token']);
        if ($request->hasFile('image') && $request->file('image')->isValid())
        {
            $params['cols']['image'] = $this->uploadFile($request->file('image'));
        }
        $params['cols']['id'] = $id;
        $banner = new Banner();
        $res = $banner->saveUpdate($params);
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
        return $file->storeAs('image_banner',$fileName,'public');
    }

    public function delete($id, Request $request) {
        $banner = new Banner();
        $banner->deleteOne($id);
        $this->v['banners'] = $banner->loadListWithPager();
        $this->v['extParams'] = $request->all();
        return view('admin.banners.list-banner', $this->v);
    }
}
