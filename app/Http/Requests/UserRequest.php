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
            'email.required'=>'Vui l??ng nh???p email',
            'name.required'=>'Vui l??ng nh???p t??n ng?????i d??ng',
            'email.unique'=>'Email ???? t???n t???i',
            'password.required'=>'Vui l??ng nh???p m???t kh???u',
            'email.email'=>'Vui l??ng nh???p ????ng ?????nh d???ng email',
            'old_password.required'=>'Vui l??ng nh???p m???t kh???u c??',
            'new_password.required'=>'Vui l??ng nh???p m???t kh???u m???i',
            'new_password.confirmed'=>'M???t kh???u m???i kh??ng kh???p',
            'new_password_confirmation.required'=>'Vui l??ng nh???p nh???p l???i m???t kh???u m???i'
        ];
    }
}
