<?php

namespace EliteFifa\SeasonBundle\Enum;

class RenewalType
{
    const MANUAL = 'manual';
    const AUTOMATIC = 'automatic';

    /**
     * @return array
     */
    public static function getLabels()
    {
        $labels = [];
        $labels[self::MANUAL] = "Manual";
        $labels[self::AUTOMATIC] = "Automatic";
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