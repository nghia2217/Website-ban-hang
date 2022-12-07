<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionRequest extends FormRequest
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
                    case 'addPromotion':
                        $rules = [
                            "name"=>"required",
                            "promotion_price"=>"required"
                        ];
                        break;
                    case 'update':
                        $rules = [
                            "name"=>"required",
                            "promotion_price"=>"required"
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
            'name.required'=>'Vui lòng nhập tên khuyễn mãi',
            'promotion_price.required'=>'Vui lòng nhập giá khuyễn mãi'
        ];
    }
}
