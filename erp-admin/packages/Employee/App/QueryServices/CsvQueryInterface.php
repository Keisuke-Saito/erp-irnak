<?php
declare(strict_types=1);

namespace Employee\App\QueryServices;

use Employee\App\Models\Csv;
use Employee\App\Models\CsvData;

/**
 * csv
 */
interface CsvQueryInterface
{
    /**
     * csv取得
     *
     * @param CsvData $csvData
     * @return Csv
     */
    public function getCsv(CsvData $csvData): Csv;
}
