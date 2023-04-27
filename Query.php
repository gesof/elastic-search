<?php

namespace Gesof\ElasticSearch;

use Elastic\Elasticsearch\Client;
use Gesof\ElasticSearch\Query\CountQuery;
use Gesof\ElasticSearch\Response\SearchResponse;
use Gesof\ElasticSearch\Response\CountResponse;

/**
 * Description of Query
 *
 * @author seby
 */
class Query 
{
    protected Client $client;
    protected array $params = [];
    
    public function __construct(Client $client, $params)
    {
        $this->client = $client;
        $this->params = $params;
    }
    
    /**
     * Set max results
     * 
     * @param integer $maxResults
     *
     * @return $this
     */
    public function setMaxResults(int $maxResults): static
    {
        $this->params['size'] = $maxResults;

        return $this;
    }
    
    /**
     * Set first result (offset)
     * 
     * @param integer $firstResult
     *
     * @return $this
     */
    public function setFirstResult(int $firstResult): static
    {
        $this->params['from'] = $firstResult;
        
        return $this;
    }
    
    /**
     * @todo check if index, search or delete
     */
    public function search(): SearchResponse
    {
        $rsp = $this->client->search($this->params);
        
        return new SearchResponse($rsp);
    }
    
    /**
     * 
     * @return CountResponse
     */
    public function count(): CountResponse
    {
        $countQuery = $this->createCountQuery();
        
        return $countQuery->count();
    }
    
    /**
     * 
     * @return CountQuery
     */
    public function createCountQuery(): Query\CountQuery
    {
        return new Query\CountQuery($this->client, $this->params);
    }
    
    public function toArray(): array
    {
        return $this->params;
    }
}
