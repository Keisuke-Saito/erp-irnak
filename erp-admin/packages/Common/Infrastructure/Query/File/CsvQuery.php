<?php
declare(strict_types=1);

namespace Common\Infrastructure\Query\File;

use Common\App\Models\Csv;
use Common\App\Models\CsvData;
use Common\App\QueryServices\CsvQueryInterface;


/**
 * csvリポジトリ
 */
class CsvQuery implements CsvQueryInterface
{
    /**
     * csv取得
     *
     * @param CsvData $request
     * @return Csv
     */
    public function getCsv(CsvData $request): Csv
    {
        $csvData = $request->getCsvData()->getItems();
        array_unshift($csvData, $request->getHeader());
        $stream = fopen('php://temp', 'r+b');
        foreach ($csvData as $csvList) {
            fputcsv($stream, $csvList);
        }
        rewind($stream);
        $csv = mb_convert_encoding(
            str_replace(PHP_EOL, "\r\n", stream_get_contents($stream)),
            $request->getCsvChara(),
            $request->getDataChara()
        );
        $csvModel = new Csv();
        return $csvModel->fill([
            'filename' => $request->getFilename(),
            'csv' => $csv
        ]);
    }
}
