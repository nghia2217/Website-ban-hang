<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Category;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function detail(Request $request) {
        $category = new Category();
        $this->v['categories'] = $category->loadListWithPager();
        return view('client.user', $this->v);
    }

    public function changePassword(Request $request) {
        $category = new Category();
        $this->v['categories'] = $category->loadListWithPager();
        return view('client.change-password', $this->v);
    }

    public function updatePassword(UserRequest $request) {


        if(!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Mật khẩu cũ không chính xác");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("success", "Thay đổi mật khẩu thành công");
    }

    public function changeInformation(Request $request) {
        $category = new Category();
        $this->v['categories'] = $category->loadListWithPager();
        return view('client.change-information', $this->v);
    }

    public function updateInformation($id,UserRequest $request) {
        $method_route = 'Route_Frontend_User_ChangeInformation';
        $params = [];
        $params['cols'] = $request->post();
        unset( $params['cols']['_token']);
        if ($request->hasFile('image') && $request->file('image')->isValid())
        {
            $params['cols']['image'] = $this->uploadFile($request->file('image'));
        }
        $params['cols']['id'] = $id;
        $user = new \App\Models\User();
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
}
