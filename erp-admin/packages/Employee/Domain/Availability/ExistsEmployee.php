<?php
declare(strict_types=1);

namespace Employee\Domain\Availability;

use Employee\Domain\Repositories\EmployeeRepositoryInterface;
use Employee\Infrastructure\Base\Model\BaseDomainModel;
use Employee\Infrastructure\Exceptions\NotFoundException;
use Log;

/**
 * 従業員情報が存在するかチェック
 * @property string ERROR
 */
final class ExistsEmployee
{
    /** @var EmployeeRepositoryInterface 社員登録情報接続 */
    private $employeeRepository;
    /** @var string エラーメッセージ */
    private const INVALID_TYPE = 'チェックタイプが正しくありません';
    /** @var string エラーメッセージ */
    private const USER_NOT_EXISTS_ERROR = '従業員ログイン情報が存在しません';
    /** @var string エラーメッセージ */
    private const PROFILE_NOT_EXISTS_ERROR = '従業員情報が存在しません';
    /** @var array<string> チェックタイプ */
    const USER = 'USER';
    const PROFILE = 'PROFILE';

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
     * 従業員情報が存在するかチェック
     *
     * @param BaseDomainModel $domainModel
     * @return void
     * @throws NotFoundException
     */
    public function exists(BaseDomainModel $domainModel, array $typeList): void
    {
        foreach ($typeList as $type) {
            switch ($type) {
                case self::USER :
                    if (!$this->employeeRepository->userExists($domainModel)) throw new NotFoundException(self::USER_NOT_EXISTS_ERROR);
                    break;
                case self::PROFILE :
                    if (!$this->employeeRepository->profileExists($domainModel)) throw new NotFoundException(self::PROFILE_NOT_EXISTS_ERROR);
                    break;
                default :
                    throw new NotFoundException(self::INVALID_TYPE);
            }
        }
    }
}
