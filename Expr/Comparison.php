<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Gesof\ElasticSearch\Expr;

/**
 * Description of Comparison
 *
 * @author seby
 */
class Comparison
{
    const EQ  = 'match';
//    const NEQ = '<>';
    const LT  = 'lt';
    const LTE = 'lte';
    const GT  = 'gt';
    const GTE = 'gte';
    
    /**
     * @var mixed
     */
    protected $leftExpr;

    /**
     * @var string
     */
    protected $operator;

    /**
     * @var mixed
     */
    protected $rightExpr;

    /**
     * Creates a comparison expression with the given arguments.
     * 
     * @param mixed  $leftExpr
     * @param string $operator
     * @param mixed  $rightExpr
     */
    public function __construct($leftExpr, $operator, $rightExpr)
    {
        $this->leftExpr  = $leftExpr;
        $this->operator  = $operator;
        $this->rightExpr = $rightExpr;
    }

    /**
     * @return mixed
     */
    public function getLeftExpr()
    {
        return $this->leftExpr;
    }

    /**
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @return mixed
     */
    public function getRightExpr()
    {
        return $this->rightExpr;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->leftExpr . ' ' . $this->operator . ' ' . $this->rightExpr;
    }
    
    public function toArray()
    {
        if ($this->operator === self::EQ) {
            $params = array(
                $this->operator => array(
                    $this->leftExpr => $this->rightExpr
                )
            );
        }
        else {
            $params = array(
                'range' => array(
                    $this->leftExpr => array(
                        $this->operator => $this->rightExpr
                    )
                )
            );
        }
        
        return $params;
    }
}
