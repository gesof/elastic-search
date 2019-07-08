<?php

namespace Gesof\ElasticSearch;

use Elasticsearch\Client;

use Gesof\ElasticSearch\Response\SearchResponse;
use Gesof\ElasticSearch\Response\CountResponse;

/**
 * Description of Query
 *
 * @author seby
 */
class Query 
{
    /** @var \Elasticsearch\Client */
    protected $client;
    protected $params = array();
    
    public function __construct(Client $client, $params)
    {
        $this->client = $client;
        $this->params = $params;
    }
    
    /**
     * Set max results
     * 
     * @param integer $maxResults
     * @return $this
     */
    public function setMaxResults($maxResults)
    {
        $this->params['size'] = $maxResults;

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
        $this->params['from'] = $firstResult;
        
        return $this;
    }
    
    /**
     * @todo check if index, search or delete
     */
    public function search()
    {
        $rsp = $this->client->search($this->params);
        
        return new SearchResponse($rsp);
    }
    
    /**
     * 
     * @return CountResponse
     */
    public function count()
    {
        $countQuery = $this->createCountQuery();
        
        return $countQuery->count();
    }
    
    /**
     * 
     * @return \Gesof\ElasticSearch\Query\CountQuery
     */
    public function createCountQuery()
    {
        return new Query\CountQuery($this->client, $this->params);
    }
    
    public function toArray()
    {
        return $this->params;
    }
}
