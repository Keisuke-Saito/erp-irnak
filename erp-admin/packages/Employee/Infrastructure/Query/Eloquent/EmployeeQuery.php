<?php
declare(strict_types=1);

namespace Employee\Infrastructure\Query\Eloquent;

use App\Models as DBA;

use Employee\App\Models\CsvData;
use Employee\App\Models\Employee;
use Employee\App\Collections\EmployeeCollection;
use Employee\App\Collections\EmployeeCsvCollection;
use Employee\App\QueryServices\EmployeeQueryInterface;
use Employee\App\Port\InputAdapter;
use Employee\Infrastructure\Exceptions\NotFoundException;

use Carbon\Carbon;


/**
 * Eloquent 従業員情報クエリ
 */
class EmployeeQuery implements EmployeeQueryInterface
{
    /**
     * 対象月の社員のcsv情報を取得
     *
     * @param InputAdapter $request
     * @return CsvData
     */
    public function getEmployeeCsvDataByTargetMonth(InputAdapter $request): CsvData
    {
        $target = $request->get('target')->endOfMonth();
        $profiles = DBA\Profile::withTrashed()
            ->where('created_at', '<=', $target->copy()->toDateString())
            ->get();
        $profiles->sortBy('kana');
        $checkList = [];
        // 重複するIDのデータがある場合は最新を取得
        foreach ($profiles as $index => $dbModel) {
            $erpId = $dbModel->erp_id;
            $createdAt = $dbModel->created_at;
            if (array_key_exists($erpId, $checkList)) {
                $checkIndex = $checkList[$erpId];
                $checkCreatedAt = $profiles->get($checkIndex)->created_at;
                if ($checkCreatedAt <= $createdAt) {
                    $profiles->forget($checkIndex);
                    $checkList[$erpId] = $index;
                } else {
                    $profiles->forget($index);
                }
            } else {
                $checkList[$erpId] = $index;
            }
        }

        $fareCsvCollection = new EmployeeCsvCollection();
        foreach ($profiles as $profile) {
            $status = '所属';
            if (is_null($profile->joined_at)) {
                $status = '未入社';
            } elseif (isset($profile->retirement_at)) {
                if ($target->copy()->gte((new Carbon($profile->retirement_at))->endOfMonth())) $status = '退職';
            }
            $fareCsvCollection->push([
                $profile->erp_id,
                $profile->name,
                $profile->belongMst()->first()->name,
                $status
            ]);
        }
        $fareCsv = new CsvData();
        $fareCsv->fill([
            'csvData' => $fareCsvCollection,
            'header' => $request->get('header'),
            'csvChara' => $request->get('csvChara'),
            'dataChara' => $request->get('dataChara'),
            'filename' => $request->get('filename')
        ]);
        return $fareCsv;
    }

    /**
     * 従業員情報全件取得
     *
     * @return EmployeeCollection
     */
    public function allEmployee(): EmployeeCollection
    {
        $allEmployeeModels = DBA\Profile::all();
        $allEmployeeModels->sortBy('kana');
        $checkList = [];
        // 重複するIDのデータがある場合は最新を取得
        foreach ($allEmployeeModels as $index => $dbModel) {
            $erpId = $dbModel->erp_id;
            $createdAt = $dbModel->created_at;
            if (array_key_exists($erpId, $checkList)) {
                $checkIndex = $checkList[$erpId];
                $checkCreatedAt = $allEmployeeModels->get($checkIndex)->created_at;
                if ($checkCreatedAt <= $createdAt) {
                    $allEmployeeModels->forget($checkIndex);
                    $checkList[$erpId] = $index;
                } else {
                    $allEmployeeModels->forget($index);
                }
            } else {
                $checkList[$erpId] = $index;
            }
        }
        $collection = new EmployeeCollection();
        foreach ($allEmployeeModels as $dbModel) {
            $loginDiv = null;
            $user = $dbModel->User()->first();
            if (!is_null($user)) {
                $loginDiv = is_null($user->deleted_at);
            }
            $model = new Employee();
            $model->fill($dbModel->toArray());
            $model->setLoginDiv($loginDiv);
            $collection->push($model);
        }
        return $collection;
    }

    /**
     * 従業員詳細情報履歴取得
     *
     * @param  InputAdapter $request
     * @return EmployeeCollection
     */
    public function profileHistory(InputAdapter $request): EmployeeCollection
    {
        $loginDiv = null;
        $user = DBA\User::withTrashed()->where('erp_id', $request->get('erpId'))->first();
        if (is_null($user)) {
            $profile = DBA\Profile::withTrashed()->where('erp_id', $request->get('erpId'))->orderBy('created_at', 'desc')->get();
            if ($profile->count() === 0) throw new NotFoundException('有効なユーザーが登録されていません');
        } else {
            $loginDiv = is_null($user->deleted_at);
            $profile = $user->allProfile()->get();
        }
        $collection = new EmployeeCollection();
        foreach ($profile as $dbModel) {
            $model = new Employee();
            $model->fill($dbModel->toArray());
            $model->setLoginDiv($loginDiv);
            $model->setCreatedAt((new Carbon($dbModel->created_at))->format('Y-m-d H:i:s'));
            $collection->push($model);
        }
        return $collection;
    }

    /**
     * 従業員詳細情報取得
     *
     * @param  InputAdapter $request
     * @return Employee
     */
    public function profileDetail(InputAdapter $request): Employee
    {
        $loginDiv = null;
        $profile = DBA\Profile::withTrashed()->where('uuid', $request->get('uuid'))->first();
        if (is_null($profile)) throw new NotFoundException('有効なユーザーが登録されていません');
        $user = DBA\User::withTrashed()->where('erp_id', $profile->erp_id)->first();
        if (isset($user)) $loginDiv = is_null($user->deleted_at);
        $model = new Employee;
        $model->fill($profile->toArray());
        $model->setLoginDiv($loginDiv);
        return $model;
    }
}
