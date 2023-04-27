<?php

namespace Gesof\ElasticSearch\Query;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Gesof\ElasticSearch\Response\CountResponse;

/**
 * Description of CountQuery
 *
 * @author seby
 */
class CountQuery
{
    protected Client $client;
    protected array $params = [];
    
    public function __construct(Client $client, $params)
    {
        unset($params['from']);
        unset($params['size']);

        unset($params['body']['size']);
        unset($params['body']['sort']);
        unset($params['body']['_source']);
        
        $this->client = $client;
        $this->params = $params;
    }

    /**
     * @throws ClientResponseException
     * @throws ServerResponseException
     */
    public function count(): CountResponse
    {
        /** @var $rsp \Elastic\Elasticsearch\Response\Elasticsearch */
        $rsp = $this->client->count($this->params);

        return new CountResponse($rsp);
    }
    
    public function toArray(): array
    {
        return $this->params;
    }
}
