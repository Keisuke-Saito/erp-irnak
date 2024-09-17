<?php

namespace App\Http\Api\Auth\CreateUser;

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
            'token' => 'required|string',
            'erpId' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string'
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

    /**
     * バリデーションエラーのカスタム属性の取得
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'token' => 'ワンタイムトークン',
            'erpId' => '管理番号',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }
}
