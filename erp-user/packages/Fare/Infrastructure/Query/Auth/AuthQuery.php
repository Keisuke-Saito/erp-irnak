<?php
declare(strict_types=1);

namespace Fare\Infrastructure\Query\Auth;

use App\Models as DBA;

use Fare\App\Models\UserInfo;
use Fare\App\QueryServices\AuthQueryInterface;
use Fare\App\Port\InputAdapter;
use Fare\Infrastructure\Exceptions\NotFoundException;

/**
 * Package 従業員情報クエリ
 * @property PackageQuery $packageQuery
 */
final class AuthQuery implements AuthQueryInterface
{
    /**
     * ErpIdで従業員取得
     *
     * @param InputAdapter $request
     * @return UserInfo
     */
    public function findFromRequestByErpId(InputAdapter $request): UserInfo
    {
        $params = $request->all();
        $user = DBA\User::where('erp_id', $params['erpId'])->first();
        if (is_null($user)) throw new NotFoundException('有効なユーザーが登録されていません');
        $profile = DBA\Profile::withTrashed()->where('erp_id', $request->get('erpId'))->first();
        if (is_null($profile)) throw new NotFoundException('有効なユーザーが登録されていません');
        $model = new UserInfo();
        $model->fill($profile->toArray());
        return $model;
    }
}
