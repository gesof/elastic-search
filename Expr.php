<?php

namespace Gesof\ElasticSearch;

/**
 * Description of Expr
 *
 * @author seby
 */
class Expr 
{
    protected $expressions = array();
    
    public function andX(array $args = array())
    {
        return new Expr\AndX($args);
    }
    
    public function orX(array $args = array())
    {
        return new Expr\OrX($args);
    }
    
    public function eq($x, $y)
    {
        return new Expr\Comparison($x, Expr\Comparison::EQ, $y);
    }
    
    public function isNull($field)
    {
        return new Expr\IsNull($field);
    }

    public function isNotNull($field)
    {
        return new Expr\IsNotNull($field);
    }
    
    public function gt($x, $y)
    {
        return new Expr\Comparison($x, Expr\Comparison::GT, $y);
    }

    public function gte($x, $y)
    {
        return new Expr\Comparison($x, Expr\Comparison::GTE, $y);
    }
    
    public function lt($x, $y)
    {
        return new Expr\Comparison($x, Expr\Comparison::LT, $y);
    }

    public function lte($x, $y)
    {
        return new Expr\Comparison($x, Expr\Comparison::LTE, $y);
    }
    
    public function matchText($field, $text)
    {
        return new Expr\MatchText($field, $text);
    }
    
    public function toArray()
    {
        
    }
}
