<?php
declare(strict_types=1);

namespace App\Http\Api\Employee\CsvDownloadExample;

use App\Http\Api\Base\Controller\Controller;
use Employee\App\Services\EmployeeListCsvDounload;
use Employee\Infrastructure\Port\Input\Request\EmployeeListCsvDounloadRequest;
use Illuminate\Http\Response;

/**
 * CSV情報を取得
 * @property EmployeeListCsvDounload $service
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var EmployeeListCsvDounload CSV情報 */
    private $service;
    /** @var Responder CSV情報レスポンス */
    private $responder;

    /**
     * Store a new controller instance.
     *
     * @param EmployeeListCsvDounload $service
     * @param Responder $responder
     * @return void
     */
    public function __construct(
        EmployeeListCsvDounload $service,
        Responder $responder
    ) {
        $this->service = $service;
        $this->responder = $responder;
    }

    /**
     * CSV情報を取得
     *
     * @param RequestValidation $request
     * @return Response
     */
    public function __invoke(RequestValidation $request): Response
    {
        $csv = $this->service->execute(new EmployeeListCsvDounloadRequest(new RequestValue($request)));
        return $this->responder
            ->setValue(new ResponseValue($csv))
            ->response();
    }
}
