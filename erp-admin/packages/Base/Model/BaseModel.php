<?php
declare(strict_types=1);

namespace Base\Model;

use Base\Exceptions\MethodNotAllowedException;

trait BaseModel
{
    /** @var string 想定されていない呼び出しのエラー */
    private static $unexpected = '[%s]は想定されていない呼び出しです。';
    /** @var string uuid */
    protected $uuid;

    /** @var array<string> モデルには含めない情報 */
    private static $notApplicabel = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * プロパティにvalueObjectをセット
     *
     * @param mixed $name
     * @param mixed $value
     * @return self
     */
    private function set($name, $value): self
    {
        $this->$name = $value;
        return $this;
    }

    /**
     * プロパティを取り出し
     *
     * @param mixed $name
     * @return mixed|null
     */
    public function get($name)
    {
        if(isset($this->$name)) {
            return $this->$name;
        } else {
            return null;
        }
    }

    /**
     * プロパティをjsonで取り出し
     *
     * @uses set(), get(), exception()
     * @param mixed $name
     * @param mixed $args
     * @return mixed|null
     * @throws MethodNotAllowedException
     */
    public function __call($name, $args)
    {
        if (!is_string($name)) $this->exception($name);
        if (strlen($name) < 4) $this->exception($name);
        $methodType = substr($name, 0, 3);
        $propatyName = lcfirst(substr($name, 3));
        if (property_exists(get_class($this), $propatyName)) {
            switch ($methodType) {
                case 'set':
                    return $this->set($propatyName, $args[0]);
                case 'get':
                    return $this->get($propatyName);
            }
        }
        $this->exception($name);
    }

    /**
     * プロパティをjsonで取り出し
     *
     * @uses toArray()
     * @return array
     */
    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * プロパティを配列で取り出し
     *
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * プロパティのセット
     * 存在しない呼び出しはエラー
     *
     * @param array $attributes
     * @return $this
     *
     * @throws MethodNotAllowedException
     */
    public function fill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            if (in_array($key, self::$notApplicabel, true)) continue;
            $property = $this->convCamel($key);
            if (property_exists($this, $property)) {
                $this->$property = $value;
            } else {
                $this->exception($key);
            }
        }
        return $this;
    }

    /**
     * スネークケースからキャメルケースに変換
     *
     * @param string $key
     * @return string
     */
    protected function convCamel(string $key): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $key))));
    }

    /**
     * パスカルケースからスネークケースに変換
     *
     * @param string $key
     * @return string
     */
    protected function convSnake(string $key): string
    {
        return strtolower(preg_replace('/[A-Z]/', '_$0', lcfirst($key)));
    }

    /**
     * 想定されていない呼び出しのエラー
     *
     * @param string $name
     * @return void
     * @throws MethodNotAllowedException
     */
    private function exception(string $name)
    {
        throw new MethodNotAllowedException(sprintf(self::$unexpected, $name));
    }
}
