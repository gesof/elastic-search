<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Gesof\ElasticSearch\Expr;

/**
 * Description of IsNull
 *
 * @author seby
 */
class IsNull implements ExprInterface
{
    protected $field;
    
    public function __construct($field)
    {
        $this->field = $field;
    }
    
    public function toArray()
    {
        return array(
            'bool' => array(
                'must_not' => array(
                    'exists' => array(
                        'field' => $this->field,
                        'boost' => 1
                    )
                )
            )
        );
    }
}
