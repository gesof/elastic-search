<?php

namespace Gesof\ElasticSearch\Expr;

/**
 * Description of AndX
 *
 * @author seby
 */
class AndX extends Base
{
    /**
     * 
     * @return type
     */
    public function toArray()
    {
        return array(
            'bool' => array(
                'must' => array_map(function($part) {
                    return $part->toArray();
                }, $this->parts)
            )
        );
    }
}
