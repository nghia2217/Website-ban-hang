<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //
    public function getLogin() {
        return view('auth.login');
    }

    public function postLogin(Request $request) {
        $rules = [
            'email'=>'required|email',
            'password'=>'required'
        ];

        $messages = [
            'email.required'=>'Không được để trống email',
            'email.email'=>'Vui lòng nhập đúng định dạng email',
            'password.required'=>'Không được để trống mật khẩu'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/login')->withErrors($validator);
        } else {
            $email = $request->input('email');
            $password = $request->input('password');
            if (Auth::attempt(['email'=>$email,'password'=>$password, 'status'=>1, 'id_role'=>1])) {
                return redirect('/admin/users');
            } else {
                Session::flash('error','Sai email hoặc mật khẩu');
                return redirect('/admin/login');
            }
        }
    }

    public function getLogout() {
        Auth::logout();
        return redirect('/admin/login');
    }

    public function getLoginClient() {
        return view('client.login');
    }

    public function postLoginClient(Request $request) {
        $rules = [
            'email'=>'required|email',
            'password'=>'required'
        ];

        $messages = [
            'email.required'=>'Không được để trống email',
            'email.email'=>'Vui lòng nhập đúng định dạng email',
            'password.required'=>'Không được để trống mật khẩu'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('/login')->withErrors($validator);
        } else {
            $email = $request->input('email');
            $password = $request->input('password');
            if (Auth::attempt(['email'=>$email,'password'=>$password])) {
                return redirect('/');
            } else {
                Session::flash('error','Sai email hoặc mật khẩu');
                return redirect('/login');
            }
        }
    }

    public function getLogoutClient() {
        Auth::logout();
        return redirect('/');
    }
}
