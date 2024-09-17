<?php
declare(strict_types=1);

namespace Employee\App\Services;

use Employee\App\Port\InputAdapter;
use Employee\Domain\Availability\ExistsMaster;
use Employee\Domain\Availability\UniqEmail;
use Employee\Domain\Availability\UniqOnetimeToken;
use Employee\Domain\Notification\EmployeeNotificationInterface;
use Employee\Domain\Repositories\EmployeeRepositoryInterface;
use Employee\Domain\Repositories\OnetimeTokenRepositoryInterface;

/**
 * 従業員登録
 *
 * @property ExistsMaster $existsMaster
 * @property UniqEmail $uniqEmail
 * @property UniqOnetimeToken $uniqOnetimeToken
 * @property EmployeeNotificationInterface $mail
 * @property EmployeeRepositoryInterface $employeeRepository
 * @property OnetimeTokenRepositoryInterface $onetimeTokenRepository
 */
final class Store
{
    /** @var ExistsMaster 設定値がマスターに存在するかチェック */
    private $existsMaster;
    /** @var UniqEmail メールアドレスの一意性確認 */
    private $uniqEmail;
    /** @var UniqOnetimeToken ワンタイムトークンの一意性確認 */
    private $uniqOnetimeToken;
    /** @var EmployeeNotificationInterface メール送信処理 */
    private $mail;
    /** @var EmployeeRepositoryInterface 登録情報接続 */
    private $employeeRepository;
    /** @var OnetimeTokenRepositoryInterface ワンタイムトークン情報接続 */
    private $onetimeTokenRepository;

    /**
     * Store a new controller instance.
     *
     * @param ExistsMaster $employeeRepository
     * @param UniqEmail $uniqEmail
     * @param UniqOnetimeToken $uniqOnetimeToken
     * @param EmployeeNotificationInterface $employeeRepository
     * @param EmployeeRepositoryInterface $employeeRepository
     * @param OnetimeTokenRepositoryInterface $onetimeTokenRepository
     * @return void
     */
    public function __construct(
        ExistsMaster $existsMaster,
        UniqEmail $uniqEmail,
        UniqOnetimeToken $uniqOnetimeToken,
        EmployeeNotificationInterface $mail,
        EmployeeRepositoryInterface $employeeRepository,
        OnetimeTokenRepositoryInterface $onetimeTokenRepository
    ){
        $this->existsMaster = $existsMaster;
        $this->uniqEmail = $uniqEmail;
        $this->uniqOnetimeToken = $uniqOnetimeToken;
        $this->mail = $mail;
        $this->employeeRepository = $employeeRepository;
        $this->onetimeTokenRepository = $onetimeTokenRepository;
    }

    /**
     * 新規従業員情報を登録
     *
     * @param InputAdapter $request
     * @return void
     * @throws ValidationException
     */
    public function execute(InputAdapter $request): void
    {
        // 入力値から従業員モデル作成
        $storeModel = $this->employeeRepository->newStoreModel($request);

        // データの整合性チェック
        $this->existsMaster->exists($storeModel);
        $this->uniqEmail->isUniqEmail($storeModel);
        $this->uniqOnetimeToken->isUniqOnetimeToken($storeModel);

        // 永続化
        $this->employeeRepository->createProfile($storeModel);
        $this->onetimeTokenRepository->createOnetimeToken($storeModel);

        // パスワード設定のメールを送信
        $this->mail->passwordSetting($storeModel);
    }
}
