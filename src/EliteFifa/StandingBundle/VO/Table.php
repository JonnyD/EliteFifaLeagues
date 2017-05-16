<?php

namespace EliteFifa\StandingBundle\VO;

class Table
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Standing[]
     */
    private $standings;

    public function __construct()
    {
        $this->standings = [];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Standing[]
     */
    public function getStandings()
    {
        return $this->standings;
    }

    /**
     * @param Standing[] $standings
     */
    public function setStandings($standings)
    {
        $this->standings = $standings;
    }
}
