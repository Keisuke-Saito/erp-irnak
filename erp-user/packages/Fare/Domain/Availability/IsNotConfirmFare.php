<?php
declare(strict_types=1);

namespace Fare\Domain\Availability;

use Fare\Domain\Repositories\FareRepositoryInterface;
use Fare\Infrastructure\Base\Model\BaseDomainModel;
use Fare\Infrastructure\Exceptions\ValidationException;

/**
 * 確定していないことをチェック
 * @property FareRepositoryInterface $fareRepository
 */
final class IsNotConfirmFare
{
    /** @var FareRepositoryInterface 交通費情報接続 */
    private $fareRepository;
    /** @var string エラーメッセージ */
    private const UNAUTHORIZED = '既に確定している月の申請は出来ません。';

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
     * 確定していないことをチェック
     *
     * @param BaseDomainModel $domainModel
     * @return void
     * @throws ValidationException
     */
    public function isNotConfirmWhereErpId(BaseDomainModel $domainModel): void
    {
        if ($this->fareRepository->isConfirmWhereErpId($domainModel)) throw new ValidationException(self::UNAUTHORIZED);
    }

    /**
     * 確定していないことをチェック
     *
     * @param BaseDomainModel $domainModel
     * @return void
     * @throws ValidationException
     */
    public function isNotConfirmWhereFareId(BaseDomainModel $domainModel): void
    {
        if ($this->fareRepository->isConfirmWhereFareId($domainModel)) throw new ValidationException(self::UNAUTHORIZED);
    }
}
