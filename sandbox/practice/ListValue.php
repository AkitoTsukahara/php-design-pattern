<?php
/**
 * PHPのクラスをforeachで回せるようにする→ファーストクラスコレクションの実現に有効的
 * 書き写し
 * https://qiita.com/kazuhei/items/a62561ca58ca8d3632e8
 *
 */

/**
 * Class ListValue
 */
class ListValue implements \IteratorAggregate, \ArrayAccess, \Countable
{
    private $array;

    public function _construct(array $array)
    {
        // keyが連番の数字になることを強要する
        $this->array = array_values($array);
    }

    public function count(): int
    {
        return count($this->array);
    }

    /* IteratorAggregateインターフェースの実装 */

    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->array[$offset] : null;
    }

    /* ArrayAccessインターフェースの実装 */

    public function offsetExists($offset)
    {
        return isset($this->array[$offset]);
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->array[] = $value;
        } else {
            $this->array[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->array[$offset]);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->array);
    }
}