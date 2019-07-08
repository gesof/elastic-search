<?php

namespace Gesof\ElasticSearch;

/**
 * Description of QueryBuilder
 *
 * @author seby
 */
class QueryBuilder 
{
    /** @var \Elasticsearch\Client */
    protected $client;
    /** @var string Table like */
    protected $index;
    /** 
     * Elastic search will deprecate this
     * https://www.elastic.co/guide/en/elasticsearch/reference/6.x/removal-of-types.html#_schedule_for_removal_of_mapping_types
     * @var string Database like 
     */
    protected $type;
    
    protected $parts = array(
        'includes' => array(), // fields to include in final set
        'excludes' => array(), // fields to exclude from final set
        'where' => NULL,
        'sort' => array(),
        'size' => NULL, // result limit
        'from' => NULL, // result offset
    );
    
    /**
     * 
     * @param type $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }
    
    /**
     * Include fields in final set
     * 
     * @param array $fields
     * @return $this
     */
    public function include(array $fields)
    {
        $this->parts['includes'] = $fields;
        
        return $this;
    }
    
    /**
     * Exclude fields from final set
     * 
     * @param array $fields
     * @return $this
     */
    public function exclude(array $fields)
    {
        $this->parts['excludes'] = $fields;
        
        return $this;
    }
    
    /**
     * Creates a new expresion
     * 
     * @return \Gesof\ElasticSearch\Expr
     */
    public function expr()
    {
        return new Expr();
    }
    
    /**
     * Set index (table)
     * 
     * @param type $table
     * @return $this
     */
    public function setTable($table)
    {
        $this->index = $table;
        
        return $this;
    }
    
    /**
     * Set collection (table)
     * 
     * @deprecated will pe removed in future elastic search versions
     * 
     * https://www.elastic.co/guide/en/elasticsearch/reference/current/removal-of-types.html
     * 
     * @param type $database
     * @return $this
     */
    public function setDatabase($database)
    {
        $this->type = $database;
        
        return $this;
    }
    
    public function orderBy($field, $direction)
    {
        $this->parts['sort'] = array();
        
        $this->addOrderBy($field, $direction);
        
        return $this;
    }
    
    public function addOrderBy($field, $direction)
    {
        $this->parts['sort'][$field] = $direction;
        
        return $this;
    }
    
    /**
     * Set max results
     * 
     * @param integer $maxResults
     * @return $this
     */
    public function setMaxResults($maxResults)
    {
        $this->parts['size'] = $maxResults;

        return $this;
    }
    
    /**
     * Set first result (offset)
     * 
     * @param integer $firstResult
     * @return $this
     */
    public function setFirstResult($firstResult)
    {
        $this->parts['from'] = $firstResult;
        
        return $this;
    }
    
    /**
     * Set where condition
     * 
     * @param type $expr
     * @return $this
     */
    public function where($expr)
    {
        $this->parts['where'] = $expr;
        
        return $this;
    }
    
    /**
        $params = [
            'index' => $rule->getIndex(),
            'type' => $rule->getBucket(),
//            'body' => [
//                'query' => [
//                    'match' => [
//                        'testField' => 'abc'
//                    ]
//                ]
//            ]
            'body' => array(
                'query' => array(
                    'bool' => array(
                        'must' => array(
                            array(
                                'match' => array(
                                    'projects' => '123'
                                )
                            ),
                            array(
                                'match' => array(
                                    'id' => 'abcd'
                                )
                            ),
                        )
                    )
                )
            )
        ];
     * @return type
     */
    
    /**
     * 
     * @return \Gesof\ElasticSearch\Query
     */
    public function getQuery()
    {
        return new Query($this->client, $this->toArray());
    }
    
    public function toArray()
    {
        $data = array(
            'index' => $this->index,
            'type' =>  $this->type,
        //    'body' => array()
        );
        
        if ($this->parts['where']) {
            $data['body']['query'] = $this->parts['where']->toArray();
        }
        
        if (count($this->parts['includes']) > 0) {
            $data['body']['_source']['includes'] = $this->parts['includes'];
        }

        if (count($this->parts['excludes']) > 0) {
            $data['body']['_source']['excludes'] = $this->parts['excludes'];
        }
        
        if (count($this->parts['sort']) > 0) {
            $data['body']['sort'] = $this->parts['sort'];
        }

        if ($this->parts['from']) {
            $data['body']['from'] = $this->parts['from'];
        }
        
        if ($this->parts['size']) {
            $data['body']['size'] = $this->parts['size'];
        }
        
        return $data;
    }
}
