<?php

namespace App\Http\Api\Employee\Store;

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
            'lastname' => ['required', 'string'],
            'firstname' => ['required', 'string'],
            'lastnameKana' => ['required', 'regex:/^([ァ-ン]|ー)+$/u'],
            'firstnameKana' => ['required', 'regex:/^([ァ-ン]|ー)+$/u'],
            'birthday' => ['required', 'format_y_m_d'],
            'gender' => ['required', 'integer'],
            'birthplace' => ['nullable', 'integer'],
            'spouse' => ['nullable', 'boolean'],
            'postalCode' => ['required', 'regex:/^\d{3}-\d{4}$/'],
            'prefectural' => ['required', 'integer'],
            'address' => ['required', 'string'],
            'nearestStation' => ['nullable', 'string'],
            'enducationalBackground' => ['nullable', 'integer'],
            'email' => ['required', 'email'],
            'contactNumber' => ['required', 'regex:/^0\d{1,4}-\d{1,4}-\d{3,4}$/'],
            'emergencyContactNumber' => ['nullable', 'regex:/^0\d{1,4}-\d{1,4}-\d{3,4}$/'],
            'recruitmentClassification' => ['nullable', 'integer'],
            'belongId' => ['nullable', 'integer'],
            'affiliationDeptId' => ['nullable', 'integer'],
            'positionId' => ['nullable', 'integer'],
            'employeeDivId' => ['nullable', 'integer'],
            'businessDivId' => ['nullable', 'integer'],
            'businessContent' => ['nullable', 'string'],
            'joinedAt' => ['required', 'format_y_m_d'],
            'operationDestinationName' => ['nullable', 'string'],
            'operationDestination' => ['nullable', 'string'],
            'possessionQualification' => ['required', 'possession_qualification'],
            'note' => ['nullable', 'string']
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
            'birthday.format_y_m_d' => __('validation.custom.date_format'),
            'joined_at.format_y_m_d' => __('validation.custom.date_format'),
            'possessionQualification.possession_qualification' => __('validation.custom.possession_qualification')
        ];
    }
}
