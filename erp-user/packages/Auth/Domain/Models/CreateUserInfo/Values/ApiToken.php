<?php
declare(strict_types=1);

namespace Auth\Domain\Models\CreateUserInfo\Values;

use Auth\Infrastructure\Bass\Model\BaseValue;
use Auth\Domain\Models\CreateUserInfo\GenerateApiToken;

final class ApiToken extends BaseValue
{
    /** @var string カラム名 */
    protected $column = 'api認証トークン';

    /**
     * Store a new controller instance.
     *
     * @param GenerateApiToken $value
     * @return void
     */
    public function __construct(GenerateApiToken $value)
    {
        $this->value = $value();
    }

    /**
     * ハッシュされたトークンを返す
     *
     * @return string
     */
    public function getHashedValue(): string
    {
        return hash('sha256', $this->value);
    }
}
