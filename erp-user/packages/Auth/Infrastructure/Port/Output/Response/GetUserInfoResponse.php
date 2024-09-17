<?php
declare(strict_types=1);

namespace Auth\Infrastructure\Port\Output\Response;

use Auth\App\Collections\ProfileCollection;
use Auth\App\Port\OutputAdapter;

/**
 * ユーザー情報レスポンス
 * @property ProfileCollection $profileCollection
 */
final class GetUserInfoResponse implements OutputAdapter
{
    /** @var ProfileCollection ユーザー情報 */
    private $profileCollection;

    /**
     * Store a new controller instance.
     *
     * @param ProfileCollection $profileCollection
     * @return void
     */
    public function __construct(
        ProfileCollection $profileCollection
    ){
        $this->profileCollection = $profileCollection;
    }

    /**
     * ユーザー情報
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->profileCollection->toArray();
    }
}
