<?php
declare(strict_types=1);

namespace Employee\Infrastructure\Port\Output\Response;

use Employee\App\Port\OutputAdapter;
use Employee\App\Models\Csv;

/**
 * csvレスポンス
 * @property Csv $csv
 */
final class CsvResponse implements OutputAdapter
{
    /** @var Csv csv */
    private $csv;

    /**
     * Store a new controller instance.
     *
     * @param Csv $csv
     * @return void
     */
    public function __construct(
        Csv $csv
    ){
        $this->csv = $csv;
    }

    /**
     * csv取得
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->csv->toArray();
    }
}
