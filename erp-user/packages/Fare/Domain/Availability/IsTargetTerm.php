<?php
declare(strict_types=1);

namespace Fare\Domain\Availability;

use Fare\App\Port\InputAdapter;
use Fare\Domain\Repositories\FareRepositoryInterface;
use Fare\Infrastructure\Base\Model\BaseDomainModel;
use Fare\Infrastructure\Exceptions\ValidationException;

/**
 * 対象日が申請対象期間かチェック
 * @property FareRepositoryInterface $fareRepository
 */
final class IsTargetTerm
{
    /** @var FareRepositoryInterface 交通費情報接続 */
    private $fareRepository;
    /** @var string エラーメッセージ */
    private const UNAUTHORIZED = '[%s]は対象期間外の日付です。';

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
     * 対象日が申請対象期間かチェック
     *
     * @param BaseDomainModel $domainModel
     * @return void
     * @throws ValidationException
     */
    public function isTargetTermStoreFare(BaseDomainModel $domainModel): void
    {
        $targetMonth = $domainModel->getTargetMonth()->getValue();
        $details = $domainModel->getDetail()->getValue();
        foreach ($details->getItems() as $detail) {
            if ($targetMonth === $detail->getTargetDate()->carbon()->format('Y-m')) continue;

            throw new ValidationException(sprintf(self::UNAUTHORIZED, $detail->getTargetDate()->getValue()));
        }
    }

    /**
     * 対象日が申請対象期間かチェック
     *
     * @param BaseDomainModel $domainModel
     * @return void
     * @throws ValidationException
     */
    public function isTargetTermWhereFareId(BaseDomainModel $domainModel): void
    {
        if ($this->fareRepository->isTargetTermWhereFareId($domainModel)) return;

        throw new ValidationException(sprintf(self::UNAUTHORIZED, $domainModel->getTargetDate()->getValue()));
    }
}
