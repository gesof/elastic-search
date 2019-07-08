<?php

namespace Gesof\ElasticSearch\Response;

/**
 * Description of CountResponse
 *
 * @author seby
 */
class CountResponse 
{
    protected $rsp;
    
    public function __construct($rsp)
    {
        $this->rsp = $rsp;
    }

    public function toArray()
    {
        return $this->rsp;
    }
    
    /**
     * @return integer Result count
     */
    public function getCount()
    {
        return array_key_exists('count', $this->rsp) ? (int) $this->rsp['count'] : 0;
    }
}
