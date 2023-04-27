<?php

namespace Gesof\ElasticSearch\Result;

/**
 * Description of Document
 *
 * @author seby
 */
class Document implements \IteratorAggregate, \Countable, \ArrayAccess
{
    protected array $data = [];
    
    /**
     * 
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }
    
    /**
     * Get data (fields values)
     * 
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
    
    /**
     * Get field value
     * 
     * @param string $field
     *
     * @return mixed
     */
    public function __get(string $field)
    {
        if (!isset($this->data[$field])) {
            return null;
        }

        return $this->data[$field];
    }
    
    /**
     * Check if field exists and has value. This method is called by empty()
     * 
     * @param string $field
     *
     * @return boolean
     */
    public function __isset(string $field)
    {
        return isset($this->data[$field]);
    }
    
    /**
     * @param string $name
     * @param mixed  $value
     */
    public function __set(string $name, mixed $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->fields);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->__set($offset, $value);
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return null !== $this->__get($offset);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        $this->__set($offset, null);
    }

    /**
     *
     * @param mixed $offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->__get($offset);
    }
}
