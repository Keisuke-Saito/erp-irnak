<?php
declare(strict_types=1);

namespace Base\Model;

use Base\Exceptions\ValidationException;

trait BaseValue
{
    /** @var string バリュー */
    protected $value;
    /** @var string カラム名 */
    protected $column;
    /** @var string nullエラー */
    private $notNullable = '%sに値がセットされていません。';
    /** @var string バリデーションエラー */
    private $notAvailable = '[%s]は%sには使えない値です。';

    /**
     * バリューチェック
     *
     * @param mixed $value
     * @return void
     */
    public function __construct($value)
    {
        if (is_null($this->column)) throw new Exception();
        if ($this->nullable() && is_null($value)) {
            $this->value = null;
        } elseif (!$this->nullable() && is_null($value)) {
            $this->nullException();
        }  elseif ($this->isValidValue($value)) {
            $this->value = $value;
        } else {
            $this->validationException($value);
        }
    }

    /**
     * null許可
     *
     * @param bool
     */
    protected function nullable(): bool
    {
        return false;
    }

    /**
     * バリデーションルール
     *
     * @param mixed $value
     * @return bool
     */
    protected function isValidValue($value): bool
    {
        return false;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getColumnName(): string
    {
        return $this->column;
    }

    /**
     * nullエラー
     *
     * @return void
     * @throws ValidationException
     */
    private function nullException()
    {
        throw new ValidationException(sprintf($this->notNullable, $this->column));
    }

    /**
     * バリデーションエラー
     *
     * @return void
     * @param mixed $value
     *
     * @throws ValidationException
     */
    private function validationException($value)
    {
        throw new ValidationException(sprintf($this->notAvailable, $value, $this->column));
    }
}
