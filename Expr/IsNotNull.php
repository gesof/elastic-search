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
class IsNotNull implements ExprInterface
{
    protected string $field;
    
    public function __construct(string $field)
    {
        $this->field = $field;
    }
    
    public function toArray(): array
    {
        return [
            'bool' => [
                'must' => [
                    'exists' => [
                        'field' => $this->field,
                        'boost' => 1
                    ]
                ]
            ]
        ];
    }
}
