<?php

namespace Gesof\ElasticSearch\Response;

use Gesof\ElasticSearch\Result\Document;
use Elastic\Elasticsearch\Response\Elasticsearch as ElasticsearchResponse;

/**
 * Description of SearchResponse
 *
 * @author seby
 */
class SearchResponse
{
    protected ElasticsearchResponse $rsp;
    
    protected array $documents = [];
    
    public function __construct(ElasticsearchResponse $rsp)
    {
        $this->rsp = $rsp;
        $responseData = $rsp->asArray();

        $results = $responseData['hits']['hits'] ?? [];
        
        foreach ($results as $resultData) {
            $document = new Document($resultData['_source']);
            
            $this->documents[] = $document;
        }
    }
    
    public function getDocuments(): array
    {
        return $this->documents;
    }
    
    public function toArray(): array
    {
        return $this->rsp->asArray();
    }
}
