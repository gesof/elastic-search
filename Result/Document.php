<?php

namespace Gesof\ElasticSearch\Result;

/**
 * Description of Document
 *
 * @author seby
 */
class Document implements \IteratorAggregate, \Countable, \ArrayAccess
{
    protected $data = array();
    
    /**
     * 
     * @param array $data
     */
    public function __construct(array $data = array())
    {
        $this->data = $data;
    }
    
    /**
     * Get data (fields values)
     * 
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
    
    /**
     * Get field value
     * 
     * @param string $field
     * @return mixed
     */
    public function __get($field)
    {
        if (!isset($this->data[$field])) {
            return;
        }

        return $this->data[$field];
    }
    
    /**
     * Check if field exists and has value. This method is called by empty()
     * 
     * @param string $field
     * @return boolean
     */
    public function __isset($field)
    {
        return isset($this->data[$field]);
    }
    
    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
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
    public function count()
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
