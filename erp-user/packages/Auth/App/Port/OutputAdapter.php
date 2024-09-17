<?php
declare(strict_types=1);

namespace Auth\App\Port;

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
