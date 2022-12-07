<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                    case 'addProduct':
                        $rules = [
                            "name"=>"required",
                            "image"=>"required",
                            "price"=>"required",
                            "description"=>"required"
                        ];
                        break;
                    case 'update':
                        $rules = [
                            "name"=>"required",
                            "price"=>"required",
                            "description"=>"required"
                        ];
                        break;
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
            'name.required'=>'Vui lòng nhập tên sản phẩm',
            'image.required'=>'Vui lòng chọn hình ảnh',
            'price.required'=>'Vui lòng nhập đơn giá',
            'description.required'=>'Vui lòng nhập mô tả'
        ];
    }
}
