<?php


namespace Gesof\ElasticSearch\Expr;

/**
 * Description of Base
 *
 * @author seby
 */
abstract class Base implements ExprInterface
{
    protected $parts = array();
    
    /**
     * 
     * @param array $args
     */
    public function __construct(array $args = array())
    {
        foreach ($args as $arg) {
            $this->parts[] = $arg;
        }
    }
    
    /**
     * Add argument
     * 
     * @param type $arg
     * @return $this
     */
    public function add($arg)
    {
        $this->parts[] = $arg;
        
        return $this;
    }
    
    
    /**
     * @return integer
     */
    public function count()
    {
        return count($this->parts);
    }
}
