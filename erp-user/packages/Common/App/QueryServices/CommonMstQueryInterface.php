<?php
declare(strict_types=1);

namespace Common\App\QueryServices;

use Common\App\Collections\Collection;

/**
 * 一般マスタ情報
 */
interface CommonMstQueryInterface
{
    /**
     * 一般マスタ情報全件取得
     *
     * @return Collection
     */
    public function getBelongMst(): Collection;

    /**
     * 一般マスタ情報全件取得
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * 一般マスタ情報全件取得
     *
     * @return Collection
     */
    public function masterForEmployee(): Collection;
}
