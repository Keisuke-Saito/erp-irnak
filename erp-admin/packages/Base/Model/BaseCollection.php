<?php
declare(strict_types=1);

namespace Base\Model;

/**
 * コレクションのベースクラス
 *
 * @property array $items
 * @property string[] private static $collectionOrModels
 * @method mixed|null first() 最初の要素取得
 * @method array getItems() 要素取得
 * @method self setItems(array $items) 要素を全て入れ替える
 * @method self push($value) 要素追加
 * @method array toArray() 配列に変換
 * @method array only(array $argments) コレクション中の指定したアイテムのみを返す
 * @method array|null get(string $keyName) 指定されたキーのアイテムを返す
 * @method int sum($keyName = null) コレクションの全アイテムの合計を返す
 * @method self onlyDeep(array $argments) 要素毎に指定されたキーを返す
 * @method self groupDeepProperties(array $argments) 指定されたキー毎にまとめて返す
 * @method self getDeepProperty(string $keyName) 指定されたキーのプロパティを返す
 * @method self where(string $keyName, $value) 指定したキー／値ペアでコレクションをフィルタリング
 * @method array private classUsesDeep($class, $autoload = true) 親クラスまでさかのぼってuseされているトレイトを返却する
 */
trait BaseCollection
{
    /** @var array 要素 */
    protected $items;
    /** @var array コレクションとモデルの名前空間が取得出来ないのでベタ書き */
    private static $collectionOrModels = [
        __namespace__ . '\BaseCollection',
        __namespace__ . '\BaseModel',
        __namespace__ . '\BaseDomainModel'
    ];

    /**
     * @param array $value
     * @return void
     */
    public function __construct(array $value = [])
    {
        $this->items = $value;
    }

    /**
     * 最初の要素取得
     *
     * @return mixed|null
     */
    public function first()
    {
        if (empty($this->items)) return null;
        return $this->items[0];
    }

    /**
     * 要素取得
     *
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * 要素を全て入れ替える
     *
     * @param array $items
     * @return self
     */
    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }

    /**
     * 要素追加
     *
     * @param mixed $value
     * @return self
     */
    public function push($value): self
    {
        $this->items[] = $value;
        return $this;
    }

    /**
     * 配列に変換
     *
     * @return array
     */
    public function toArray(): array
    {
        $result = [];
        foreach ($this->items as $key => $item) {
            if (is_object($item)) {
                if (method_exists($item, 'toArray')) {
                    $item = $item->toArray();
                }
            }
            $result[$key] = $item;
        }
        return $result;
    }

    /**
     * コレクション中の指定したアイテムのみを返す
     *
     * @param array $argments
     * @return array
     * @uses get(string $keyName)
     */
    public function only(array $argments): array
    {
        $result = [];
        foreach ($argments as $argment) {
            $result[$argment] = $this->get($argment);
        }
        return $result;
    }

    /**
     * 指定されたキーのアイテムを返す
     *
     * @param string $keyName
     * @return array|null
     */
    public function get(string $keyName): ?array
    {
        foreach ($this->items as $key => $item) {
            if ($key === $keyName) return $item;
        }
        return null;
    }

    /**
     * コレクションの全アイテムの合計を返す
     * コレクションがネストした配列やオブジェクトを含んでいる場合
     * どの値を合計するのを決めるためにキーを指定してください
     *
     * @param  string|null $keyName
     * @return int
     * @uses self getDeepProperty(string $keyName)
     * @uses array toArray()
     */
    public function sum($keyName = null): int
    {
        if (is_null($keyName)) {
            return array_sum($this->items);
        }

        return array_sum($this->getDeepProperty($keyName)->toArray());
    }

    /**
     * コレクション中の要素がコレクションまたはモデルの場合に
     * 要素毎に指定されたキーを返す
     *
     * @param array $argments
     * @return self
     * @uses classUsesDeep($class, $autoload = true)
     */
    public function onlyDeep(array $argments): self
    {
        $result = [];
        foreach ($this->items as $key => $item) {
            foreach ($argments as $keyName) {
                if (!empty(array_intersect($this->classUsesDeep($item), self::$collectionOrModels))) {
                    $result[$key][$keyName] = $item->get($keyName);
                }
            }
        }
        $clone = clone $this;
        return $clone->setItems($result);
    }

    /**
     * コレクション中の要素がコレクションまたはモデルの場合に
     * 指定されたキー毎にまとめて返す
     *
     * @param array $argments
     * @return self
     * @uses self getDeepProperty(string $keyName)
     * @uses first()
     */
    public function groupDeepProperties(array $argments): self
    {
        $result = [];
        foreach ($argments as $argment) {
            $result[$argment] = $this->getDeepProperty($argment)->first();
        }
        $clone = clone $this;
        return $clone->setItems($result);
    }

    /**
     * コレクション中の要素がコレクションまたはモデルの場合に
     * 指定されたキーのプロパティを返す
     *
     * @param string $keyName
     * @return self
     * @uses classUsesDeep($class, $autoload = true)
     */
    public function getDeepProperty(string $keyName): self
    {
        $result = [];
        foreach ($this->items as $item) {
            if (!empty(array_intersect($this->classUsesDeep($item), self::$collectionOrModels))) {
                $result[] = $item->get($keyName);
            }
        }
        $clone = clone $this;
        return $clone->setItems($result);
    }

    /**
     * 指定したキー／値ペアでコレクションをフィルタリング
     *
     * @param string $keyName
     * @param mixed $value
     * @return self
     * @uses classUsesDeep($class, $autoload = true)
     */
    public function where(string $keyName, $value): self
    {
        $result = [];
        foreach ($this->items as $item) {
            if (is_array($item)) {
                if ($value === $item[$keyName]) {
                    $result[] = $item;
                    continue;
                }
            }
            if (!empty(array_intersect($this->classUsesDeep($item), self::$collectionOrModels))) {
                if ($value === $item->get($keyName)) {
                    $result[] = $item;
                    continue;
                }
            }
        }
        $clone = clone $this;
        return $clone->setItems($result);
    }

    /**
     * 親クラスまでさかのぼってuseされているトレイトを返却する
     * class_uses関数の拡張
     *
     * @param $class
     * @param bool $autoload
     * @return array
     */
    private function classUsesDeep($class, $autoload = true) {
        $traits = [];
        do {
            $traits = array_merge(class_uses($class, $autoload), $traits);
        } while($class = get_parent_class($class));
        foreach ($traits as $trait => $same) {
            $traits = array_merge(class_uses($trait, $autoload), $traits);
        }
        return array_unique($traits);
    }
}
