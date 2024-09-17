<?php
declare(strict_types=1);

namespace Employee\Domain\Models\Delete;

use Employee\Infrastructure\Base\Model\BaseDomainModel;

/**
 * 従業員ログイン情報削除モデル
 *
 * @property Values\ErpId $erpId
 * @method array toArray()
 * @method string convSnake(string $key)
 */
final class DeleteModel extends BaseDomainModel
{
    protected $erpId;
    /**
     * Store a new controller instance.
     *
     * @param ErpId $erpId
     */
    public function __construct(
        Values\ErpId $erpId
    ){
        $this->erpId = $erpId;
    }
}
