<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\Store;

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
            'detail' => ['required'],
            'detail.*.targetDate' => ['required_with:detail.*.targetDate', 'date'],
            'detail.*.destination' => ['required_with:detail.*.destination', 'string'],
            'detail.*.pointOfDeparture' => ['required_with:detail.*.pointOfDeparture', 'string'],
            'detail.*.arrival' => ['required_with:detail.*.arrival', 'string'],
            'detail.*.routeDiv' => ['required_with:detail.*.routeDiv', 'integer'],
            'detail.*.transportation' => ['required_with:detail.*.transportation', 'integer'],
            'detail.*.amountOfMoney' => ['required_with:detail.*.amountOfMoney', 'integer', 'gte:0'],
            'detail.*.remarks' => ['string', 'nullable'],
            'detail.*.adminRemarks' => ['string', 'nullable'],
            'detail.*.receipt' => ['file', 'mimes:jpeg,jpg,JPG,png,PNG', 'nullable'],
            'targetMonth' => ['required', 'format_y_m']
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
            '*' => __('validation.custom.please_confirm')
        ];
    }

    /**
     * バリデーションエラーのカスタム属性の取得
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'detail.*.targetDate' => '日付',
            'detail.*.destination' => '行先',
            'detail.*.pointOfDeparture' => '出発地',
            'detail.*.arrival' => '到着地',
            'detail.*.routeDiv' => '片道・往復・定期',
            'detail.*.transportation' => '交通手段',
            'detail.*.amountOfMoney' => '金額',
            'detail.*.remarks' => '備考欄',
            'detail.*.receipt' => '定期の画像',
            'targetMonth' => '対象月',
        ];
    }
}
