<?php

namespace Gesof\ElasticSearch\Expr;

/**
 * Description of OrX
 *
 * @author seby
 */
class OrX extends Base
{
    /**
     * 
     * @return type
     */
    public function toArray()
    {
        return array(
            'bool' => array(
                'should' => array_map(function($part) {
                    return $part->toArray();
                }, $this->parts)
            )
        );
    }
}
