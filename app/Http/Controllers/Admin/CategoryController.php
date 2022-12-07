<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    //
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function category(Request $request) {
        $category = new Category();
        $this->v['categories'] = $category->loadListWithPager();
        $this->v['extParams'] = $request->all();
        return view('admin.categories.list-category', $this->v);
    }

    public function addCategory(CategoryRequest $request) {
        $method_route = 'router_BackEnd_AddCategory_index';
        $this->v['_title'] = "Thêm danh mục";
        if ($request->isMethod('post')) {
            //dd($request->post());//dong data post gui sang
            $params = [];
            $params['cols'] = $request->post();
            unset( $params['cols']['_token']);
            $modelCategory = new Category();
            $res = $modelCategory->saveNew($params);
            if ($res == null) {
                return redirect()->route($method_route);
            } elseif ($res>0) {
                Session::flash('success','Thêm mới danh mục thành công');
            } else {
                Session::flash('error', 'Lỗi khi thêm mới danh mục');
            }
        }
        return view('admin.categories.add-category',$this->v);
    }

    public function detail($id, Request $request) {
        $this->v['_title'] = "Chi tiết danh mục";
        $category = new Category();
        $objItem = $category->loadOne($id);
        $this->v['objItem'] = $objItem;
        return view('admin.categories.detail', $this->v);
    }

    public function update($id, CategoryRequest $request) {
        $method_route = 'route_Backend_Category_Detail';
        $params = [];
        $params['cols'] = $request->post();
        unset( $params['cols']['_token']);
        $params['cols']['id'] = $id;
        $category = new Category();
        $res = $category->saveUpdate($params);
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
        $category = new Category();
        $category->deleteOne($id);
        $this->v['categories'] = $category->loadListWithPager();
        $this->v['extParams'] = $request->all();
        return view('admin.categories.list-category', $this->v);
    }
}
