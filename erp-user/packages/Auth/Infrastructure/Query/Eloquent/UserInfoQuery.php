<?php
declare(strict_types=1);

namespace Auth\Infrastructure\Query\Eloquent;

use App\Models as DBA;

use Auth\App\Collections\ProfileCollection;
use Auth\App\Models\UserInfo;
use Auth\App\QueryServices\UserInfoQueryInterface;
use Auth\App\Port\InputAdapter;
use Auth\Infrastructure\Exceptions\NotFoundException;

use Carbon\Carbon;

/**
 * Eloquent ユーザー情報クエリ
 */
class UserInfoQuery implements UserInfoQueryInterface
{
    /**
     * ErpIdでユーザー情報取得
     *
     * @param InputAdapter $request
     * @return ProfileCollection
     * @throws NotFoundException
     */
    public function findFromRequestByErpId(InputAdapter $request): ProfileCollection
    {
        $params = $request->all();
        $user = DBA\User::where('erp_id', $params['erpId'])->first();
        if (is_null($user)) throw new NotFoundException('有効なユーザーが登録されていません');
        $profile = $user->allProfile()->get();
        if ($profile->count() === 0) throw new NotFoundException('有効なユーザーが登録されていません');
        $collection = new ProfileCollection();
        foreach ($profile as $dbModel) {
            $model = new UserInfo();
            $model->fill($dbModel->toArray());
            $model->setCreatedAt((new Carbon($dbModel->created_at))->format('Y-m-d H:i:s'));
            $collection->push($model);
        }
        return $collection;
    }
}
