<?php
declare(strict_types=1);

namespace App\Http\Api\Base\Validator;

use \Illuminate\Validation\Validator;
use Carbon\Carbon;

class CustomValidator extends Validator
{
    /**
     * 日付のフォーマットチェック:yyyymm
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateFormatYM($attribute, $value, $parameters)
    {
        try {
            if (!is_string($value)) return false;
            list($y, $m) = explode('-', $value);
            $value = $y . '-' . sprintf('%02d', $m) . '-01';
            $date = new Carbon($value);
            return $date->copy()->toDateString() === $value;
        } catch (\Exception $e) {
            return false;
        }
    }
    /**
     * 日付のフォーマットチェック:yyyymmdd
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateFormatYMD($attribute, $value, $parameters)
    {
        try {
            if (!is_string($value)) return false;
            list($y, $m, $d) = explode('-', $value);
            $value = $y . '-' . sprintf('%02d', $m) . '-' . sprintf('%02d', $d);
            $date = new Carbon($value);
            return $date->copy()->toDateString() === $value;
        } catch (\Exception $e) {
            return false;
        }
    }
    /**
     * 保有資格のフォーマットチェック
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validatePossessionQualification($attribute, $value, $parameters)
    {
        try {
            if (!is_string($value)) return false;
            $value = json_decode($value, true);
            if ($value === false) return false;
            foreach ($value as $detail) {
                if (!array_key_exists('value', $detail)) continue;
                if (!is_string($detail['value'])) return false;
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
