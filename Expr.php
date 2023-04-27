<?php

namespace Gesof\ElasticSearch;


/**
 * Description of Expr
 *
 * @author seby
 */
class Expr 
{
    protected array $expressions = [];
    
    public function andX(array $args = []): Expr\AndX
    {
        return new Expr\AndX($args);
    }
    
    public function orX(array $args = []): Expr\OrX
    {
        return new Expr\OrX($args);
    }
    
    public function eq($x, $y): Expr\Comparison
    {
        return new Expr\Comparison($x, Expr\Comparison::EQ, $y);
    }
    
    public function isNull($field): Expr\IsNull
    {
        return new Expr\IsNull($field);
    }

    public function isNotNull($field): Expr\IsNotNull
    {
        return new Expr\IsNotNull($field);
    }
    
    public function gt($x, $y): Expr\Comparison
    {
        return new Expr\Comparison($x, Expr\Comparison::GT, $y);
    }

    public function gte($x, $y): Expr\Comparison
    {
        return new Expr\Comparison($x, Expr\Comparison::GTE, $y);
    }
    
    public function lt($x, $y): Expr\Comparison
    {
        return new Expr\Comparison($x, Expr\Comparison::LT, $y);
    }

    public function lte($x, $y): Expr\Comparison
    {
        return new Expr\Comparison($x, Expr\Comparison::LTE, $y);
    }
    
    public function matchText($field, $text): Expr\MatchText
    {
        return new Expr\MatchText($field, $text);
    }
    
    public function toArray()
    {
        
    }
}
