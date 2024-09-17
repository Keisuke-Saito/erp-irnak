<?php
declare(strict_types=1);

namespace Fare\App\Services;

use Fare\Domain\Availability\IsTargetTerm;
use Fare\Domain\Availability\IsNotConfirmFare;
use Fare\Domain\Repositories\FareRepositoryInterface;
use Fare\App\Port\InputAdapter;

/**
 * 交通費登録処理
 * @property IsTargetTerm $isTargetTerm
 * @property IsNotConfirmFare $isNotConfirmFare
 * @property FareRepositoryInterface $fareRepository
 */
final class Store
{
    /** @var IsTargetTerm 対象日が申請対象期間かチェック */
    private $isTargetTerm;
    /** @var IsNotConfirmFare 確定していないことをチェック */
    private $isNotConfirmFare;
    /** @var FareRepositoryInterface 交通費情報接続 */
    private $fareRepository;

    /**
     * Store a new controller instance.
     *
     * @param IsTargetTerm $isTargetTerm
     * @param IsNotConfirmFare $isNotConfirmFare
     * @param FareRepositoryInterface $fareRepository
     * @return void
     */
    public function __construct(
        IsTargetTerm $isTargetTerm,
        IsNotConfirmFare $isNotConfirmFare,
        FareRepositoryInterface $fareRepository
    ){
        $this->isTargetTerm = $isTargetTerm;
        $this->isNotConfirmFare = $isNotConfirmFare;
        $this->fareRepository = $fareRepository;
    }

    /**
     * 交通費登録処理
     *
     * @param InputAdapter $request
     * @return void
     */
    public function execute(InputAdapter $request)
    {
        // 新規登録モデル取得
        $storeModel = $this->fareRepository->newStore($request);
        // 確定していないことをチェック
        $this->isNotConfirmFare->isNotConfirmWhereErpId($storeModel);
        // 対象日が申請対象期間かチェック
        $this->isTargetTerm->isTargetTermStoreFare($storeModel);
        // 交通費永続化
        $this->fareRepository->storeFare($storeModel);
    }
}
