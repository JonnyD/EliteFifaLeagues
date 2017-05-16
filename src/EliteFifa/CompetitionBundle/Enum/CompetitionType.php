<?php

namespace EliteFifa\CompetitionBundle\Enum;

class CompetitionType
{
    const LEAGUE = "league";
    const KNOCKOUT = "knockout";
    const MULTI_STAGE = "multi-stage";

    /**
     * @return array
     */
    public static function getLabels()
    {
        $labels = [];
        $labels[self::LEAGUE] = "League";
        $labels[self::KNOCKOUT] = "Knockout";
        $labels[self::MULTI_STAGE] = "Multi-Stage";
        return $labels;
    }

    /**
     * @param int $key
     * @return string
     */
    public static function getLabel($key)
    {
        return self::getLabels()[$key];
    }

    /**
     * @param string $label
     * @return int
     */
    public static function getKey($label)
    {
        return array_search($label, self::getLabels());
    }
}