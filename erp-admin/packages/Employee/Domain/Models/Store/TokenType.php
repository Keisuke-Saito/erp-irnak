<?php
declare(strict_types=1);

namespace Employee\Domain\Models\Store;

use Employee\Infrastructure\Exceptions\NotFoundException;

/**
 * トークンタイプ
 * @property const ERROR
 * @property const TOKEN_TYPE
 * @property string $type
 */
final class TokenType
{
    /** @var string エラーメッセージ */
    private const ERROR = '[%s]は想定されていない呼び出しです。';
    /** @var array TOKEN_TYPE */
    private const TOKEN_TYPE = [
        'CREATE_EMPLOYEE' => 1
    ];
    /** @var string トークンタイプ */
    private $type;

    /**
     * Store a new controller instance.
     *
     * @param string $type
     * @return void
     * @throws NotFoundException
     */
    public function __construct(
        string $type
    ){
        if (!array_key_exists($type, self::TOKEN_TYPE)) throw new NotFoundException(sprintf(self::ERROR, $type));

        $this->type = $type;
    }

    /**
     * トークンタイプ
     *
     * @return int
     */
    public function getType(): int
    {
        return self::TOKEN_TYPE[$this->type];
    }
}
