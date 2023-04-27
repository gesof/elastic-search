<?php

namespace Gesof\ElasticSearch\Response;

use Elastic\Elasticsearch\Response\Elasticsearch as ElasticsearchResponse;

/**
 * Description of CountResponse
 *
 * @author seby
 */
class CountResponse 
{
    protected  ElasticsearchResponse $rsp;
    
    public function __construct(ElasticsearchResponse $rsp)
    {
        $this->rsp = $rsp;
    }

    public function toArray(): array
    {
        return $this->rsp->asArray();
    }
    
    /**
     * @return integer Result count
     */
    public function getCount(): int
    {
        $rsp = $this->rsp->asArray();

        return $rsp['count'] ?? 0;
    }
}
