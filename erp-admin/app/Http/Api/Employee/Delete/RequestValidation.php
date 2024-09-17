<?php
declare(strict_types=1);

namespace App\Http\Api\Employee\Delete;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

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
            'erpId' => ['required', 'string']
        ];
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }
}
