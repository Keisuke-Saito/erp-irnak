<?php
declare(strict_types=1);

namespace Employee\Domain\Availability;

use Employee\Domain\Repositories\EmployeeRepositoryInterface;
use Employee\Infrastructure\Base\Model\BaseDomainModel;
use Employee\Infrastructure\Exceptions\ValidationException;
use Log;

/**
 * 設定値がマスターに存在するかチェック
 * @property string ERROR
 */
final class ExistsMaster
{
    /** @var EmployeeRepositoryInterface 社員登録情報接続 */
    private $employeeRepository;
    /** @var string エラーメッセージ */
    private const ERROR = '[%s]の設定値が不正な値です。';

    /**
     * Store a new controller instance.
     *
     * @param EmployeeRepositoryInterface $employeeRepository
     * @return void
     */
    public function __construct(
        EmployeeRepositoryInterface $employeeRepository
    ){
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * 設定値がマスターに存在するかチェック
     *
     * @param BaseDomainModel $domainModel
     * @return void
     * @throws ValidationException
     */
    public function exists(BaseDomainModel $domainModel)
    {
        $key = $this->employeeRepository->existsMstValues($domainModel);
        if ($key === '') return;
        throw new ValidationException(sprintf(self::ERROR, $key));
    }
}
