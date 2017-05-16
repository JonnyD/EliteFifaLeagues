<?php

namespace EliteFifa\SeasonBundle\Enum;

class SeasonStatus
{
    const NEW_SEASON = 'new';
    const IN_PROGRESS = 'in-progress';
    const FINISHED = 'finished';

    /**
     * @return array
     */
    public static function getLabels()
    {
        $labels = [];
        $labels[self::NEW_SEASON] = "NEW";
        $labels[self::IN_PROGRESS] = "IN PROGRESS";
        $labels[self::FINISHED] = "FINISHED";
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