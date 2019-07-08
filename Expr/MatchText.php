<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Gesof\ElasticSearch\Expr;

/**
 * Description of Contains
 * 
 * https://www.elastic.co/guide/en/elasticsearch/reference/current/full-text-queries.html
 * 
 * @author seby
 */
class MatchText implements ExprInterface
{
    protected $fields = array();
    protected $text;
    
    public function __construct($field, $text)
    {
        $this->fields = is_array($field) ? $field : array($field);
        $this->text = $text;
    }
    
    public function toArray()
    {
        return array(
            'simple_query_string' => array(
                'query' => $this->text,
                'fields' => $this->fields,
                'default_operator'=> 'or'
            )
        );
    }
}
