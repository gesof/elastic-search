<?php

namespace Gesof\ElasticSearch\Query;

use Elasticsearch\Client;

use Gesof\ElasticSearch\Response\CountResponse;

/**
 * Description of CountQuery
 *
 * @author seby
 */
class CountQuery
{
    /** @var \Elasticsearch\Client */
    protected $client;
    protected $params = array();
    
    public function __construct(Client $client, $params)
    {
        unset($params['from']);
        unset($params['size']);
        
        unset($params['body']['sort']);
        unset($params['body']['_source']);
        
        $this->client = $client;
        $this->params = $params;
    }
    
    public function count()
    {
        $rsp = $this->client->count($this->params);

        return new CountResponse($rsp);
    }
    
    public function toArray()
    {
        return $this->params;
    }
}
