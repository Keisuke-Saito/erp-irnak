<?php
declare(strict_types=1);

namespace Fare\Domain\Factories;

use Fare\App\Port\InputAdapter;
use Fare\Domain\Factories\FareDetailFactory;
use Fare\Domain\Models\ComfirmFare\Values as ComfirmFareValues;
use Fare\Domain\Models\ComfirmFare\ComfirmFareModel;
use Fare\Domain\Models\StoreFare\Values as StoreFareValues;
use Fare\Domain\Models\StoreFare\StoreFareModel;

/**
 * 交通費確定情報モデル生成
 * @property GenerateApiToken $token
 */
class FareFactory
{
    /** @var FareDetailFactory 交通費詳細情報モデル生成 */
    private $fareDetailFactory;

    /**
     * Store a new controller instance.
     *
     * @param FareDetailFactory $fareDetailFactory
     * @return void
     */
    public function __construct(
        FareDetailFactory $fareDetailFactory
    ){
        $this->fareDetailFactory = $fareDetailFactory;
    }

    /**
     * リクエスト情報から交通費確定情報モデル生成
     *
     * @param InputAdapter $request
     * @return StoreFareModel
     */
    public function createStoreFareModelFromRequest(InputAdapter $request): StoreFareModel
    {
        $list = $request->all();
        return new StoreFareModel(
            new StoreFareValues\ErpId($list['erpId']),
            new StoreFareValues\TargetMonth($list['targetMonth']),
            new StoreFareValues\Detail($this->fareDetailFactory->createStoreDetailCollectionFromRequest($request))
        );
    }

    /**
     * リクエスト情報から交通費確定情報モデル生成
     *
     * @param InputAdapter $request
     * @return ComfirmFareModel
     */
    public function createComfirmModelFromRequest(InputAdapter $request): ComfirmFareModel
    {
        $list = $request->all();
        return new ComfirmFareModel(
            new ComfirmFareValues\Uuid($list['uuid'])
        );
    }
}
