<?php
declare(strict_types=1);

namespace Fare\Domain\Availability;

use Fare\App\Port\InputAdapter;
use Fare\Domain\Repositories\FareRepositoryInterface;
use Fare\Infrastructure\Base\Model\BaseDomainModel;
use Fare\Infrastructure\Exceptions\ValidationException;

/**
 * 交通費情報が存在するかチェック
 * @property FareRepositoryInterface $fareRepository
 */
final class ExistsFare
{
    /** @var FareRepositoryInterface 交通費情報接続 */
    private $fareRepository;
    /** @var string エラーメッセージ */
    private const UNAUTHORIZED = '対象のレコードがありません。';

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
     * 交通費情報が存在するかチェック
     *
     * @param BaseDomainModel $domainModel
     * @return void
     * @throws ValidationException
     */
    public function existsFare(BaseDomainModel $domainModel): void
    {
        if ($this->fareRepository->doesntExistFare($domainModel)) throw new ValidationException(self::UNAUTHORIZED);
    }

    /**
     * 交通費情報が存在するかチェック
     *
     * @param BaseDomainModel $domainModel
     * @return void
     * @throws ValidationException
     */
    public function existsFareDetail(BaseDomainModel $domainModel): void
    {
        if ($this->fareRepository->doesntExistFareDetail($domainModel)) throw new ValidationException(self::UNAUTHORIZED);
    }
}
