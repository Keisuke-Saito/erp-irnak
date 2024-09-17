<?php
declare(strict_types=1);

namespace Employee\Domain\Models\Store\Values;

use Employee\Domain\Models\Store\TokenType;
use Employee\Infrastructure\Bass\Model\BaseValue;

final class TypeDiv extends BaseValue
{
    /** @var string カラム名 */
    protected $column = 'トークンタイプ';

    /**
     * Store a new controller instance.
     *
     * @param TokenType $type
     * @return void
     */
    public function __construct(TokenType $type)
    {
        $this->value = $type->getType();
    }
}
