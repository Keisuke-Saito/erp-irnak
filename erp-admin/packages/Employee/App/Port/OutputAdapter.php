<?php
declare(strict_types=1);

namespace Employee\App\Port;

/**
 * レスポンスラッパー
 */
interface OutputAdapter
{
    /**
     * レスポンス全権取得
     *
     * @return array
     */
    public function toArray(): array;
}
