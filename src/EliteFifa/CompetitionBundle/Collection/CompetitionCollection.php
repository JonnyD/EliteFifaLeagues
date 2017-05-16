<?php

namespace EliteFifa\CompetitionBundle\Collection;

use Doctrine\Common\Collections\ArrayCollection;
use EliteFifa\AssociationBundle\Entity\Association;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\SeasonBundle\Entity\Season;

class CompetitionCollection extends ArrayCollection
{
    /**
     * @param Season $season
     * @param Association $association
     * @return Competition[]
     */
    public function filterBySeasonAndAssociation(Season $season, Association $association)
    {
        $competitions = [];
        /** @var Competition $competition */
        foreach ($this->getIterator() as $competition) {
            foreach ($competition->getSeasons() as $competitionSeason) {
                if ($competitionSeason == $season) {
                    if ($competition->getAssociation() == $association) {
                        $competitions[] = $competition;
                    }
                }
            }
        }
        return $competitions;
    }
}