<?php

namespace AccSync\Pohoda\Collection;

/**
 * Class BaseCollection
 *
 * @package AccSync\Pohoda\Collection
 * @author  miroslav.soukup2@gmail.com
 */
abstract class BaseCollection implements \IteratorAggregate, \ArrayAccess, \Countable
{
    /** @var array $collection */
    protected $collection = [];

    public function getIterator()
    {
        return new \ArrayIterator($this->collection);
    }

    public function offsetExists($offset)
    {
        return isset($this->collection[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->collection[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if (is_scalar($offset))
        {
            $this->collection[$offset] = $value;
        }
        elseif ($offset == null)
        {
            $this->collection[] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->collection[$offset]);
    }

    public function count()
    {
        return count($this->collection);
    }
}