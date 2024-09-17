<?php
declare(strict_types=1);

namespace App\Http\Api\Base\Responder;

use Illuminate\Http\Response;

abstract class EmptyContentResponder implements ResponderInterface
{
    use ResponderTrait;

    /**
     * @return Illuminate\Http\Response
     */
    public function response(): Response
    {
        return $this->response
            ->setStatusCode(self::STATUS_LIST[$this->status]);
    }
}
