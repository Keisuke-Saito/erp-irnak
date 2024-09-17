<?php
declare(strict_types=1);

namespace Fare\App\Services;

use Fare\Domain\Availability\ExistsFare;
use Fare\Domain\Repositories\FareRepositoryInterface;
use Fare\App\Port\InputAdapter;

/**
 * 交通費削除処理
 * @property ExistsFare $existsFare
 * @property FareRepositoryInterface $fareRepository
 */
final class Delete
{
    /** @var ExistsFare 交通費情報が存在するかチェック */
    private $existsFare;
    /** @var FareRepositoryInterface 交通費情報接続 */
    private $fareRepository;

    /**
     * Store a new controller instance.
     *
     * @param ExistsFare $existsFare
     * @param FareRepositoryInterface $fareRepository
     * @return void
     */
    public function __construct(
        ExistsFare $existsFare,
        FareRepositoryInterface $fareRepository
    ){
        $this->existsFare = $existsFare;
        $this->fareRepository = $fareRepository;
    }

    /**
     * 交通費削除処理
     *
     * @param InputAdapter $request
     * @return void
     */
    public function execute(InputAdapter $request)
    {
        // 削除モデル取得
        $deleteDetailModel = $this->fareRepository->newDelete($request);
        // 交通費詳細情報が存在するかチェック
        $this->existsFare->existsFareDetail($deleteDetailModel);
        // 交通費削除
        $this->fareRepository->deleteDetail($deleteDetailModel);
    }
}
