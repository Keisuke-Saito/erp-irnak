<?php
declare(strict_types=1);

namespace App\Http\Api\Base\Responder;

use Illuminate\Http\Response;

abstract class CsvResponder implements ResponderInterface
{
    use ResponderTrait;

    /**
     * @return Response
     */
    public function response(): Response
    {
        $csv = $this->value->toArray();
        return $this->response
            ->setContent($csv['csv'])
            ->setStatusCode(self::STATUS_LIST[$this->status()])
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $csv['filename'] . '"');
    }
}
