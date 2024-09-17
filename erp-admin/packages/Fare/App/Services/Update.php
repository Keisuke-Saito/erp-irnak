<?php
declare(strict_types=1);

namespace Fare\App\Services;

use Fare\Domain\Availability\ExistsFare;
use Fare\Domain\Availability\IsTargetTerm;
use Fare\Domain\Repositories\FareRepositoryInterface;
use Fare\App\Port\InputAdapter;

/**
 * 交通費更新処理
 * @property ExistsFare $existsFare
 * @property IsTargetTerm $isTargetTerm
 * @property FareRepositoryInterface $fareRepository
 */
final class Update
{
    /** @var ExistsFare 交通費情報が存在するかチェック */
    private $existsFare;
    /** @var IsTargetTerm 対象日が申請対象期間かチェック */
    private $isTargetTerm;
    /** @var FareRepositoryInterface 交通費情報接続 */
    private $fareRepository;

    /**
     * Store a new controller instance.
     *
     * @param ExistsFare $existsFare
     * @param IsTargetTerm $isTargetTerm
     * @param FareRepositoryInterface $fareRepository
     * @return void
     */
    public function __construct(
        ExistsFare $existsFare,
        IsTargetTerm $isTargetTerm,
        FareRepositoryInterface $fareRepository
    ){
        $this->existsFare = $existsFare;
        $this->isTargetTerm = $isTargetTerm;
        $this->fareRepository = $fareRepository;
    }

    /**
     * 交通費更新処理
     *
     * @param InputAdapter $request
     * @return void
     */
    public function execute(InputAdapter $request)
    {
        // 更新モデル取得
        $updateDetailModel = $this->fareRepository->newUpdate($request);
        // 交通費情報が存在するかチェック
        $this->existsFare->existsFareDetail($updateDetailModel);
        // 対象日が申請対象期間かチェック
        $this->isTargetTerm->isTargetTermWhereFareId($updateDetailModel);
        // 更新処理
        $this->fareRepository->updateDetail($updateDetailModel);
    }
}
