<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function user(Request $request) {
        $user = new User();
        $this->v['users'] = $user->loadListWithPager();
        $this->v['extParams'] = $request->all();
        return view('admin.users.list-user', $this->v);
    }

    public function addUser(UserRequest $request) {
        $modelRole = new Role();
        $this->v['roles'] = $modelRole->loadListWithPager();
        $method_route = 'router_BackEnd_Add_index';
        $this->v['_title'] = "Thêm người dùng";
        if ($request->isMethod('post')) {
            //dd($request->post());//dong data post gui sang
            $params = [];
            $params['cols'] = $request->post();
            unset( $params['cols']['_token']);
            if ($request->hasFile('image') && $request->file('image')->isValid())
            {
                $params['cols']['image'] = $this->uploadFile($request->file('image'));
            }
            $modelUser = new User();
            $res = $modelUser->saveNew($params);
            if ($res == null) {
                return redirect()->route($method_route);
            } elseif ($res>0) {
                Session::flash('success','Thêm mới người dùng thành công');
            } else {
                Session::flash('error', 'Lỗi khi thêm mới người dùng');
            }
        }
        return view('admin.users.add-user', $this->v);
    }

    public function addUserClient(UserRequest $request) {
        $method_route = 'router_BackEnd_AddUserClient_index';
        if ($request->isMethod('post')) {
            //dd($request->post());//dong data post gui sang
            $params = [];
            $params['cols'] = $request->post();
            unset( $params['cols']['_token']);
            $modelUser = new User();
            $res = $modelUser->saveNew($params);
            if ($res == null) {
                return redirect()->route($method_route);
            } elseif ($res>0) {
                Session::flash('success','Đăng ký thành công. Vui lòng đăng nhập');
                return view('client.login', $this->v);
            } else {
                Session::flash('error', 'Lỗi khi đăng ký tài khoản');
            }
        }
        return view('client.register', $this->v);
    }

    public function detail($id, Request $request) {
        $this->v['_title'] = "Chi tiết người dùng";
        $user = new User();
        $role = new Role();
        $objItem = $user->loadOne($id);
        $this->v['objItem'] = $objItem;
        $this->v['roles'] = $role->loadListWithPager();
        return view('admin.users.detail', $this->v);
    }

    public function update($id,UserRequest $request) {
        $method_route = 'route_Backend_User_Detail';
        $params = [];
        $params['cols'] = $request->post();
        unset( $params['cols']['_token']);
        if ($request->hasFile('image') && $request->file('image')->isValid())
        {
            $params['cols']['image'] = $this->uploadFile($request->file('image'));
        }
        $params['cols']['id'] = $id;
        $user = new User();
        $res = $user->saveUpdate($params);
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
        return $file->storeAs('image_users',$fileName,'public');
    }

    public function delete($id, Request $request) {
        $user = new User();
        $user->deleteOne($id);
        $this->v['users'] = $user->loadListWithPager();
        $this->v['extParams'] = $request->all();
        return view('admin.users.list-user', $this->v);
    }
}
