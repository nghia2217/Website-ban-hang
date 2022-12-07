<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    //
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function role(Request $request) {
        $role = new Role();
        $this->v['roles'] = $role->loadListWithPager();
        $this->v['extParams'] = $request->all();
        return view('admin.roles.list-role', $this->v);
    }

    public function addRole(RoleRequest $request) {
        $method_route = 'router_BackEnd_AddRole_index';
        $this->v['_title'] = "Thêm vai trò";
        if ($request->isMethod('post')) {
            //dd($request->post());//dong data post gui sang
            $params = [];
            $params['cols'] = $request->post();
            unset( $params['cols']['_token']);
            $modelRole = new Role();
            $res = $modelRole->saveNew($params);
            if ($res == null) {
                return redirect()->route($method_route);
            } elseif ($res>0) {
                Session::flash('success','Thêm mới vai trò thành công');
            } else {
                Session::flash('error', 'Lôỗi khi thêm mới vai trò');
            }
        }
        return view('admin.roles.add-role', $this->v);
    }

    public function detail($id, Request $request) {
        $this->v['_title'] = "Chi tiết vai trò";
        $role = new Role();
        $objItem = $role->loadOne($id);
        $this->v['objItem'] = $objItem;
        return view('admin.roles.detail', $this->v);
    }

    public function update($id, RoleRequest $request) {
        $method_route = 'route_Backend_Role_Detail';
        $params = [];
        $params['cols'] = $request->post();
        unset( $params['cols']['_token']);
        $params['cols']['id'] = $id;
        $role = new Role();
        $res = $role->saveUpdate($params);
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
        $role = new Role();
        $role->deleteOne($id);
        $this->v['roles'] = $role->loadListWithPager();
        $this->v['extParams'] = $request->all();
        return view('admin.roles.list-role', $this->v);
    }
}
