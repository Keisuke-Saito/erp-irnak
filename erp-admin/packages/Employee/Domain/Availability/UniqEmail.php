<?php
declare(strict_types=1);

namespace Employee\Domain\Availability;

use Employee\Domain\Repositories\EmployeeRepositoryInterface;
use Employee\Infrastructure\Base\Model\BaseDomainModel;
use Employee\Infrastructure\Exceptions\ConflictException;

/**
 * メールアドレスの一意性確認
 * @property EmployeeRepositoryInterface $employeeRepository
 * @property string ERROR
 */
final class UniqEmail
{
    /** @var EmployeeRepositoryInterface 社員登録情報接続 */
    private $employeeRepository;
    /** @var string エラーメッセージ */
    private const ERROR = '既に登録されているメールアドレスです。';

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
     * メールアドレスの一意性確認
     *
     * @param BaseDomainModel $domainModel
     * @return void
     * @throws ConflictException
     */
    public function isUniqEmail(BaseDomainModel $domainModel):void
    {
        if ($this->employeeRepository->emailExists($domainModel)) throw new ConflictException(self::ERROR);
    }
}
