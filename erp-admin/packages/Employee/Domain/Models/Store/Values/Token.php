<?php
declare(strict_types=1);

namespace Employee\Domain\Models\Store\Values;

use Employee\Domain\Models\Store\OnetimeTokenGenerator;
use Employee\Infrastructure\Bass\Model\BaseValue;

use Ramsey\Uuid\Uuid;

final class Token extends BaseValue
{
    /** @var string カラム名 */
    protected $column = 'トークン';

    /**
     * Store a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->value = Uuid::uuid4()->toString();
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
