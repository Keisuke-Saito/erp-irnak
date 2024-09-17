<?php
declare(strict_types=1);

namespace Employee\Infrastructure\Query\Package;

use Employee\App\Models\Csv;
use Employee\App\Models\CsvData;
use Employee\App\QueryServices\CsvQueryInterface;
use Common\App\Models\CsvData as CommonCsvData;
use Common\App\QueryServices\CsvQueryInterface as CommonCsvQueryInterface;

/**
 * csvリポジトリ
 * @property CommonCsvQueryInterface $csvQuery
 */
class CsvQuery implements CsvQueryInterface
{
    /** @var CommonCsvQueryInterface csv取得 */
    private $csvQuery;

    /**
     * Store a new controller instance.
     *
     * @param CommonCsvQueryInterface $csvQuery
     * @return void
     */
    public function __construct(
        CommonCsvQueryInterface $csvQuery
    ){
        $this->csvQuery = $csvQuery;
    }
    /**
     * csv取得
     *
     * @param CsvData $csvData
     * @return Csv
     */
    public function getCsv(CsvData $csvData): Csv
    {
        $request = new CommonCsvData();
        $request->fill($csvData->toArray());
        $csvData = $this->csvQuery->getCsv($request);
        $csv = new Csv();
        $csv->fill($csvData->toArray());
        return $csv;
    }
}
