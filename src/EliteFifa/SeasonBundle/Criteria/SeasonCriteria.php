<?php

namespace EliteFifa\SeasonBundle\Criteria;

class SeasonCriteria
{
    /**
     * @var array
     */
    private $sort;

    /**
     * @return array
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param array $sort
     */
    public function setSort(array $sort)
    {
        $this->sort = $sort;
    }
}
