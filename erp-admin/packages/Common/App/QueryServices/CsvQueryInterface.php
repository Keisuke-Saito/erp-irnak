<?php
declare(strict_types=1);

namespace Common\App\QueryServices;

use Common\App\Models\Csv;
use Common\App\Models\CsvData;

/**
 * csv
 */
interface CsvQueryInterface
{
    /**
     * csv取得
     *
     * @param CsvData $request
     * @return Csv
     */
    public function getCsv(CsvData $request): Csv;
}
