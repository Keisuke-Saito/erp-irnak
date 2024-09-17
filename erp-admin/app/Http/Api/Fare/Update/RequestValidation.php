<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\Update;

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
            'uuid' => 'required|uuid',
            'fareId' => 'required|uuid',
            'targetDate' => 'required|date',
            'destination' => 'required|string|max:255',
            'pointOfDeparture' => 'required|string|max:255',
            'arrival' => 'required|string|max:255',
            'routeDiv' => 'required|integer',
            'transportation' => 'required|integer',
            'amountOfMoney' => 'required|integer|gte:0',
            'imgObj' => 'file|image|mimes:jpeg,jpg,JPG,png,PNG|nullable',
            'receipt' => 'string|nullable',
            'remarks' => 'string|nullable',
            'adminRemarks' => 'string|nullable',
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
            'uuid' => 'ID',
            'fareId' => '交通費情報のID',
            'targetDate' => '日付',
            'destination' => '行先',
            'pointOfDeparture' => '出発地',
            'arrival' => '到着地',
            'routeDiv' => '片道・往復・定期',
            'transportation' => '交通手段',
            'amountOfMoney' => '金額',
            'remarks' => '備考欄',
            'receipt' => '定期の画像',
            'imgObj' => '定期の画像',
        ];
    }
}
