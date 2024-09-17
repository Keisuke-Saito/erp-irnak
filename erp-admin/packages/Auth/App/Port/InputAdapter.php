<?php
declare(strict_types=1);

namespace Auth\App\Port;

/**
 * リクエストラッパー
 */
interface InputAdapter
{
    /**
     * リクエスト全権取得
     *
     * @return void
     */
    public function all(): array;
}
