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
     * @return array
     */
    public function toArray(): array
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
