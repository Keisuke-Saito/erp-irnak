<?php
declare(strict_types=1);

namespace Fare\Domain\Models\DeleteDetail\Values;

use Fare\Infrastructure\Bass\Model\BaseValue;

final class FilePath extends BaseValue
{
    /** @var string カラム名 */
    protected $column = 'ファイルパス';
    /** @var string 設定可能な値 */
    protected $configurableValue = "/^[0-9a-zA-Z-_]+(\.png$|\.jpg$|\.jpeg$)/i";

    /**
     * Store a new controller instance.
     *
     * @param $value
     * @return void
     */
    public function __construct($value)
    {
        parent::__construct($value);
    }

    /**
     * null許可
     *
     * @return bool
     */
    protected function nullable(): bool
    {
        return true;
    }

    /**
     * 設定可能な値かチェック
     *
     * @param mixed $value
     * @return bool
     */
    protected function isValidValue($value): bool
    {
        return (bool)(preg_match($this->configurableValue, $value));
    }

    /**
     * ファイル名取得
     * @return string|null
     */
    public function getBasename(): ?string
    {
        if (is_null($this->value)) return null;
        return basename($this->value);
    }
}
