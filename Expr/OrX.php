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
     * @return array
     */
    public function toArray(): array
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
