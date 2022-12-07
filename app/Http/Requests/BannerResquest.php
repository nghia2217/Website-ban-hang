<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerResquest extends FormRequest
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
                    case 'addBanner':
                        $rules = [
                            "image"=>"required",
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
            'image.required'=>'Vui lòng chọn hình ảnh',
        ];
    }
}
