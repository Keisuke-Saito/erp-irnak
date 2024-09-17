<?php
declare(strict_types=1);

namespace Fare\Domain\Models\ComfirmFare;

use Fare\Infrastructure\Base\Model\BaseDomainModel;

/**
 * 交通費確定モデル
 */
final class ComfirmFareModel extends BaseDomainModel
{
    /** @var Uuid ID */
    protected $uuid;

    /**
     * Store a new controller instance.
     *
     * @param Uuid $uuid
     */
    public function __construct(
        Values\Uuid $uuid
    ){
        $this->uuid = $uuid;
    }
}
