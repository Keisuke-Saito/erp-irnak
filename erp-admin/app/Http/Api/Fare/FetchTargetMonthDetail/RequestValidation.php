<?php

namespace App\Http\Api\Fare\FetchTargetMonthDetail;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidation extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'erpId' => 'required|string',
            'target' => 'required|format_y_m'
        ];
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages()
    {
        return [
            'target.format_y_m' => __('validation.custom.date_format')
        ];
    }
}
