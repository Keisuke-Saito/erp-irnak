<?php
declare(strict_types=1);

namespace App\Http\Api\Base\Responder;

use Illuminate\Http\Response;

abstract class ImageResponder implements ResponderInterface
{
    use ResponderTrait;

    protected $emptySetStatus = 'created';

    /**
     * @return BinaryFileResponse|Response
     */
    public function response()
    {
        $imageFile = $this->value->toArray();
        if (!is_null($imageFile['fullPath']) && !is_null($imageFile['mimeType'])) {
            $headers = [['Content-Type' => $imageFile['mimeType']]];
            return response()->file($imageFile['fullPath'] ,$headers);
        } else {
            return $this->response
                ->setContent($this->value)
                ->setStatusCode(self::STATUS_LIST[$this->status()]);
        }
    }

    /**
    * @return void
    */
    public function status()
    {
        $imageFile = $this->value;
        if (is_null($imageFile['fullPath']) && is_null($imageFile->getPath())) {
            return $this->emptySetStatus;
        } else {
            return empty($this->value) ? $this->badStatus : $this->status;
        }
    }
}
