<?php


namespace Gesof\ElasticSearch\Expr;

/**
 * Description of Base
 *
 * @author seby
 */
abstract class Base implements ExprInterface
{
    protected array $parts = [];
    
    /**
     * 
     * @param array $args
     */
    public function __construct(array $args = [])
    {
        foreach ($args as $arg) {
            $this->parts[] = $arg;
        }
    }

    /**
     * Add argument
     *
     * @param ExprInterface $arg
     *
     * @return $this
     */
    public function add(ExprInterface $arg): static
    {
        $this->parts[] = $arg;
        
        return $this;
    }
    
    
    /**
     * @return integer
     */
    public function count(): int
    {
        return count($this->parts);
    }
}
