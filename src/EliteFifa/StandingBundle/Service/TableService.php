<?php

namespace EliteFifa\StandingBundle\Service;

use EliteFifa\StandingBundle\VO\Table;

class TableService
{
    /**
     * @var StandingService
     */
    private $standingService;

    /**
     * @param StandingService $standingService
     */
    public function __construct(StandingService $standingService)
    {
        $this->standingService = $standingService;
    }

    /**
     * @param $name
     * @param $matches
     * @return Table
     */
    public function getTableByMatches($name, $matches)
    {
        $table = new Table();
        $table->setName($name);
        $standings = $this->standingService->getStandingsByMatches($matches);
        $table->setStandings($standings);
        return $table;
    }
}
