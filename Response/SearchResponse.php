<?php

namespace Gesof\ElasticSearch\Response;

use Gesof\ElasticSearch\Result\Document;

/**
 * Description of SearchResponse
 *
 * @author seby
 */
class SearchResponse
{
    protected $rsp;
    
    protected $documents = array();
    
    public function __construct($rsp)
    {
        $this->rsp = $rsp;
        
        $results = isset($this->rsp['hits']['hits']) ? $this->rsp['hits']['hits'] : array();
        
        foreach ($results as $resultData) {
            $document = new Document($resultData['_source']);
            
            $this->documents[] = $document;
        }
    }
    
    public function getDocuments()
    {
        return $this->documents;
    }
    
    public function toArray()
    {
        return $this->rsp;
    }
}
