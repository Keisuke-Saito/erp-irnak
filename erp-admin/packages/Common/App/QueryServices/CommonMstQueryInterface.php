<?php
declare(strict_types=1);

namespace Common\App\QueryServices;

use Common\App\Collections\MstCollection;

/**
 * 一般マスタ情報
 */
interface CommonMstQueryInterface
{
    /**
     * 一般マスタ情報全件取得
     *
     * @return MstCollection
     */
    public function all(): MstCollection;
}
