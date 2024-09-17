<?php
declare(strict_types=1);

namespace App\Http\Api\Base\Responder;

use App\Http\Api\Base\Connector\BaseResponseValue;
use Illuminate\Http\Response;

/**
 * @property BaseResponseValue $value
 * @property string $status
 * @property string $badStatus
 * @property Response $response
 */
trait ResponderTrait
{
    /** @var BaseResponseValue レスポンス情報 */
    private $value;
    /** @var string ステータス */
    protected $status = 'ok';
    /** @var string BATステータス */
    protected $badStatus = 'notFound';
    /** @var Response レスポンス*/
    protected $response;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        Response $response
    ){
        $this->response = $response;
    }

    /**
    * @return string
    */
    public function status(): string
    {
        return empty($this->value->toArray()) ? $this->badStatus : $this->status;
    }

    /**
     * @param BaseResponseValue $value
     * @return self
     */
    public function setValue(BaseResponseValue $value): self
    {
        $this->value = $value;
        return $this;
    }
}
