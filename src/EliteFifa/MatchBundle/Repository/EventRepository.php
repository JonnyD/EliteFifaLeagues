<?php

namespace EliteFifa\MatchBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\TeamBundle\Entity\Team;

class EventRepository extends EntityRepository
{
    public function findTopGoalScorersByCompetitionAndSeason($competition, $season)
    {
        //TODO: season
        $sql = "SELECT player_id, first_name, last_name, slug, COUNT(*) as amount
                FROM event
                INNER JOIN matches
                ON event.match_id = matches.id
                INNER JOIN player
                ON event.player_id = player.id
                INNER JOIN event_type
                ON event.event_type_id = event_type.id
                WHERE matches.league_id = " . $competition->getId() ."
                AND event_type.name = 'Goal'
                GROUP BY player_id
                ORDER BY amount DESC
                LIMIT 5;";

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('player_id', 'player_id');
        $rsm->addScalarResult('amount', 'amount');
        $rsm->addScalarResult('first_name', 'first_name');
        $rsm->addScalarResult('last_name', 'last_name');
        $rsm->addScalarResult('slug', 'slug');
        $query = $this->_em->createNativeQuery($sql, $rsm);

        return $query->getResult();
    }

    public function findTopMOMByCompetitionAndSeason($competition, $season)
    {
        $sql = "SELECT player_id, first_name, last_name, slug, COUNT(*) as amount
                FROM event
                INNER JOIN matches
                ON event.match_id = matches.id
                INNER join player
                ON event.player_id = player.id
                INNER JOIN event_type
                ON event.event_type_id = event_type.id
                WHERE matches.league_id = " . $competition->getId() . "
                AND event_type.name = 'MOM'
                GROUP BY player_id
                ORDER BY amount DESC
                LIMIT 5;";

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('player_id', 'player_id');
        $rsm->addScalarResult('amount', 'amount');
        $rsm->addScalarResult('first_name', 'first_name');
        $rsm->addScalarResult('last_name', 'last_name');
        $rsm->addScalarResult('slug', 'slug');
        $query = $this->_em->createNativeQuery($sql, $rsm);

        return $query->getResult();
    }

    public function findTopBookingsByCompetiitonAndSeason($competition, $season)
    {
        $sql = "SELECT player_id, first_name, last_name, slug, COUNT(*) as amount
                FROM event
                INNER JOIN matches
                ON event.match_id = matches.id
                INNER join player
                ON event.player_id = player.id
                INNER JOIN event_type
                ON event.event_type_id = event_type.id
                WHERE matches.league_id = " . $competition->getId() . "
                AND (event_type.name = 'Yellow Card'
                OR event_type.name = 'Red Card')
                GROUP BY player_id
                ORDER BY amount DESC
                LIMIT 5;";

        $query = $this->createRSM($sql);
        return $query->getResult();
    }

    public function findTopCleanSheetsByCompetitionAndSeason($competition, $season)
    {
        $sql = "SELECT player_id, first_name, last_name, slug, COUNT(*) as amount
                FROM event
                INNER JOIN matches
                ON event.match_id = matches.id
                INNER join player
                ON event.player_id = player.id
                INNER JOIN event_type
                ON event.event_type_id = event_type.id
                WHERE matches.league_id = " . $competition->getId() . "
                AND event_type.name = 'Cleansheet'
                GROUP BY player_id
                ORDER BY amount DESC
                LIMIT 5;";

        $query = $this->createRSM($sql);
        return $query->getResult();
    }

    private function createRSM($sql)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('player_id', 'player_id');
        $rsm->addScalarResult('amount', 'amount');
        $rsm->addScalarResult('first_name', 'first_name');
        $rsm->addScalarResult('last_name', 'last_name');
        $rsm->addScalarResult('slug', 'slug');
        $query = $this->_em->createNativeQuery($sql, $rsm);
        return $query;
    }

    public function findAmountOfYellowsForTeamByCompetitionAndSeason(Team $team, Competition $competition, Season $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT COUNT(e)
                FROM EliteFifaBundle:Event e
                JOIN e.eventType et
                JOIN e.match m
                WHERE e.team = :team
                  AND m.league = :league
                  AND m.season = :season
                  AND et.name = :eventName')
            ->setParameter('team', $team)
            ->setParameter('league', $competition)
            ->setParameter('season', $season)
            ->setParameter('eventName', 'Yellow Card');

        return $query->getSingleScalarResult();
    }

    public function findAmountOfRedsForTeamByCompetitionAndSeason(Team $team, Competition $competition, Season $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT COUNT(e)
                FROM EliteFifaBundle:Event e
                JOIN e.eventType et
                JOIN e.match m
                WHERE e.team = :team
                  AND m.league = :league
                  AND m.season = :season
                  AND et.name = :eventName')
            ->setParameter('team', $team)
            ->setParameter('league', $competition)
            ->setParameter('season', $season)
            ->setParameter('eventName', 'Red Card');

        return $query->getSingleScalarResult();
    }
}