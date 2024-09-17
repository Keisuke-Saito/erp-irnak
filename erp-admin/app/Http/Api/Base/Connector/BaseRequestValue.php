<?php
declare(strict_types=1);

namespace App\Http\Api\Base\Connector;

use App\Http\Api\Base\Exceptions\MethodNotAllowedException;

abstract class BaseRequestValue implements BaseConnecter
{
    public function get($name)
    {
        if(isset($this->$name)) {
            return $this->$name;
        } else {
            return null;
        }
    }

    public function __call($name, $args)
    {
        if (!is_string($name)) $this->exception($name);
        if (strlen($name) < 4) $this->exception($name);
        $methodType = substr($name, 0, 3);
        $propatyName = lcfirst(substr($name, 3));
        if (property_exists(get_class($this), $propatyName)) {
            switch ($methodType) {
                case 'get':
                    return $this->get($propatyName);
            }
        }
        $this->exception($name);
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * 想定されていない呼び出しのエラー
     *
     * @param string $name
     * @throws MethodNotAllowedException
     */
    private function exception(string $name)
    {
        throw new MethodNotAllowedException(sprintf('[%s]は想定されていない呼び出しです。', $name));
    }
}
