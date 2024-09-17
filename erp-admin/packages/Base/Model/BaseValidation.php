<?php
declare(strict_types=1);

namespace Base\Model;

use Carbon\Carbon;

trait BaseValidation
{
    /**
     * IDとして正しいか
     *
     * @param mixed $value
     * @return bool
     */
    protected static function isUuid($value): bool
    {
        return (bool)preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/", $value);
    }

    /**
     * IDとして正しいか
     *
     * @param mixed $value
     * @return bool
     */
    protected static function isId($value): bool
    {
        if (is_int($value) && 0 < $value) {
            return true;
        }

        try {
            return is_int($value * 1);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * 管理番号IDとして正しいか
     *
     * @param mixed $value
     * @return bool
     */
    protected static function isStringId($value): bool
    {
        return (bool)preg_match("/^[0-9a-zA-Z-_]+$/", $value);
    }

    /**
     * 文字列で構成された配列として正しいか
     *
     * @param mixed $value
     * @return bool
     */
    protected static function isStringArray($value): bool
    {
        if (!is_array($value)) return false;
        foreach ($value as $item) {
            if (!is_string($item)) return false;
        }
        return true;
    }

    /**
     * 日付として正しいか
     *
     * @param mixed $value
     * @return bool
     */
    protected static function isDate($value): bool
    {
        try {
            if (!is_string($value)) return false;
            list($y, $m, $d) = explode('-', $value);
            $value = $y . '-' . sprintf('%02d', $m) . '-' . sprintf('%02d', $d);
            $date = new Carbon($value);
            return $date->toDateString() === $value;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * 都道府県として正しいか
     *
     * @param mixed $value
     * @return bool
     */
    protected static function isPrefectural($value): bool
    {
        return array_key_exists($value, config('const.COMMON.PREFECTURAL'));
    }

    /**
     * 郵便番号として正しいか
     *
     * @param mixed $value
     * @return bool
     */
    protected static function isPostalCode($value): bool
    {
        return (bool)preg_match("/^[0-9]{3}-[0-9]{4}$/", $value);
    }

    /**
     * 電話番号として正しいか
     *
     * @param mixed $value
     * @return bool
     */
    protected static function isPhoneNumber($value): bool
    {
        return (bool)preg_match("/^(0{1}\d{1,4}-\d{1,4}-\d{3,4})$/", $value);
    }

    /**
     * メールアドレスとして正しいか
     *
     * @param mixed $value
     * @return bool
     */
    protected static function isEmail($value): bool
    {
        // ＠の存在チェック
        if (strpos($value, '@') === false) {
            return false;
        }

        // ２５５文字超過チェック
        if (strlen($value) > 255) {
            return false;
        }

        // ＠前が１文字から６４文字のチェック
        $emailString = explode('@', $value);
        if (strlen($emailString[0]) > 64 || strlen($emailString[0]) < 1) {
            return false;
        }

        // ＠後に . の存在チェック
        if (!preg_match('/.+\..+/', $emailString[1])) {
            return false;
        }

        return true;

        // return (bool)preg_match('/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $value);
    }
}
