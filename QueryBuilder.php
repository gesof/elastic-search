<?php

namespace Gesof\ElasticSearch;

use Gesof\ElasticSearch\Expr\ExprInterface;
use Elastic\Elasticsearch\Client;

/**
 * Description of QueryBuilder
 *
 * @author seby
 */
class QueryBuilder 
{
    protected Client $client;
    /** @var string Table like */
    protected string $index;
    /** 
     * Elastic search will deprecate this
     * https://www.elastic.co/guide/en/elasticsearch/reference/6.x/removal-of-types.html#_schedule_for_removal_of_mapping_types
     * @var string Database like 
     */
    protected $type;
    
    protected array $parts = [
        'includes' => [], // fields to include in final set
        'excludes' => [], // fields to exclude from final set
        'where' => NULL,
        'sort' => [],
        'size' => NULL, // result limit
        'from' => NULL, // result offset
    ];

    /**
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    
    /**
     * Include fields in final set
     * 
     * @param array $fields
     * @return $this
     */
    public function include(array $fields): static
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
    public function exclude(array $fields): static
    {
        $this->parts['excludes'] = $fields;
        
        return $this;
    }
    
    /**
     * Creates a new expresion
     * 
     * @return Expr
     */
    public function expr(): Expr
    {
        return new Expr();
    }

    /**
     * Set index (table)
     *
     * @param string $table
     *
     * @return $this
     */
    public function setTable(string $table): static
    {
        $this->index = $table;
        
        return $this;
    }

    /**
     * Set collection (table)
     *
     * @param string $database
     *
     * @return $this
     * @deprecated will pe removed in future elastic search versions
     *
     * https://www.elastic.co/guide/en/elasticsearch/reference/current/removal-of-types.html
     *
     */
    public function setDatabase(string $database): static
    {
        $this->type = $database;
        
        return $this;
    }
    
    public function orderBy($field, $direction): static
    {
        $this->parts['sort'] = [];
        
        $this->addOrderBy($field, $direction);
        
        return $this;
    }
    
    public function addOrderBy($field, $direction): static
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
    public function setMaxResults(int $maxResults): static
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
    public function setFirstResult(int $firstResult): static
    {
        $this->parts['from'] = $firstResult;
        
        return $this;
    }

    /**
     * Set where condition
     *
     * @param ExprInterface $expr
     *
     * @return $this
     */
    public function where(ExprInterface $expr): static
    {
        $this->parts['where'] = $expr;
        
        return $this;
    }

    /**
     * 
     * @return Query
     */
    public function getQuery(): Query
    {
        return new Query($this->client, $this->toArray());
    }
    
    public function toArray(): array
    {
        $data = [
            'index' => $this->index,
            'type' =>  $this->type,
        //    'body' => []
        ];
        
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
