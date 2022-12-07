<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];
        $currentAction = $this->route()->getActionMethod();
        switch ($this->method()):
            case 'POST':
                switch ($currentAction) {
                    case 'addUser':
                        $rules = [
                            "email"=>"required|unique:users|email",
                            "name"=>"required",
                            "password"=>"required"
                        ];
                        break;
                    case 'addUserClient':
                        $rules = [
                            "email"=>"required|unique:users|email",
                            "name"=>"required",
                            "password"=>"required"
                        ];
                        break;
                    case 'update':
                        $rules = [
                            "email"=>"required||email",
                            "name"=>"required",
                        ];
                        break;
                    case 'updatePassword':
                        $rules = [
                            'old_password' => 'required',
                            'new_password' => 'required|confirmed',
                            'new_password_confirmation' => 'required'
                        ];
                        break;
                    case 'updateInformation':
                        $rules = [
//                            "email"=>"required||email",
                            "name"=>"required",
                        ];
                    default:
                        break;
                }
                break;
        endswitch;
        return $rules;
    }

    public function messages()
    {
        return [
            'email.required'=>'Vui lòng nhập email',
            'name.required'=>'Vui lòng nhập tên người dùng',
            'email.unique'=>'Email đã tồn tại',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'email.email'=>'Vui lòng nhập đúng định dạng email',
            'old_password.required'=>'Vui lòng nhập mật khẩu cũ',
            'new_password.required'=>'Vui lòng nhập mật khẩu mới',
            'new_password.confirmed'=>'Mật khẩu mới không khớp',
            'new_password_confirmation.required'=>'Vui lòng nhập nhập lại mật khẩu mới'
        ];
    }
}
