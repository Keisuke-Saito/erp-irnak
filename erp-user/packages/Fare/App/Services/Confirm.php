<?php
declare(strict_types=1);

namespace Fare\App\Services;

use Fare\Domain\Repositories\FareRepositoryInterface;
use Fare\App\Port\InputAdapter;

/**
 * 交通費確定処理
 * @property FareRepositoryInterface $fareRepository
 */
final class Confirm
{
    /** @var FareRepositoryInterface 交通費情報接続 */
    private $fareRepository;

    /**
     * Store a new controller instance.
     *
     * @param FareRepositoryInterface $fareRepository
     * @return void
     */
    public function __construct(
        FareRepositoryInterface $fareRepository
    ){
        $this->fareRepository = $fareRepository;
    }

    /**
     * 交通費確定処理
     *
     * @param InputAdapter $request
     * @return void
     */
    public function execute(InputAdapter $request)
    {
        $comfirmFareModel = $this->fareRepository->newComfirm($request);
        $this->fareRepository->comfirmFare($comfirmFareModel);
    }
}
