<?php

namespace EliteFifa\MatchBundle\Service;

use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitionBundle\Entity\GroupStage;
use EliteFifa\CompetitionBundle\Entity\Knockout;
use EliteFifa\CompetitionBundle\Entity\KnockoutStage;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\MatchBundle\Entity\Round;
use EliteFifa\MatchBundle\Enum\RoundName;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\StandingBundle\Service\StandingService;
use EliteFifa\StandingBundle\VO\Standing;

class MatchFixturesService
{
    /**
     * @var MatchService
     */
    private $matchService;

    /**
     * @var StandingService
     */
    private $standingService;

    /**
     * @param MatchService $matchService
     * @param StandingService $standingService
     */
    public function __construct(
        MatchService $matchService,
        StandingService $standingService)
    {
        $this->matchService = $matchService;
        $this->standingService = $standingService;
    }


    /**
     * @param array $competitors
     * @param Competition $competition
     * @param Season $season
     * @return Match[]
     */
    public function createFixtures($competitors, Competition $competition, Season $season)
    {
        $rounds = [];

        $roundsCount = count($competitors) - 1;

        $away = array_splice($competitors, (count($competitors) / 2));
        $home = $competitors;
        for ($r = 0; $r < count($home)+count($away)-1; $r++) {
            for ($j = 0; $j < count($home); $j++) {
                $rounds[$r][$j]["Home"] = $home[$j];
                $rounds[$r][$j]["Away"] = $away[$j];
            }
            if ((count($home) + count($away) -1) > 2) {
                $splice = array_splice($home, 1, 1);
                $shift = array_shift($splice);
                array_unshift($away, $shift);
                array_push($home, array_pop($away));
            }
        }

        $roundNumber = count($rounds);
        foreach ($rounds as $r => $m) {
            foreach ($m as $j => $match) {
                $rounds[$roundNumber][$j]['Home'] = $match['Away'];
                $rounds[$roundNumber][$j]['Away'] = $match['Home'];
            }

            $roundNumber++;
        }

        $startDate = $season->getStartDate();
        $endDate = $season->getEndDate();

        $dateDifference = $startDate->diff($endDate);
        $days = $dateDifference->days;

        $totalRoundsCount = $roundsCount + $roundsCount;

        $dayInterval = round($days / $totalRoundsCount, 0, PHP_ROUND_HALF_DOWN);

        $fixtures = [];

        $roundNumber = 1;
        foreach ($rounds as $r => $m) {
            $startDate = clone $startDate->add(new \DateInterval('P'.$dayInterval.'D'));
            $round = new Round();
            $round->setRound($roundNumber);
            $round->setStartDate($startDate);
            $round->setName('Matchday ' . $roundNumber);

            foreach ($m as $j => $match) {
                /** @var Competitor $homeCompetitor */
                $homeCompetitor = $match['Home'];
                /** @var Competitor $awayCompetitor */
                $awayCompetitor = $match['Away'];

                $fixtures[] = $this->matchService->createMatch($homeCompetitor, $awayCompetitor, $competition, $season, $round, true);
            }

            $roundNumber++;
        }

        return $fixtures;
    }

    /**
     * @param $competitors
     * @param Competition $competition
     * @param Season $season
     * @return Match[]
     */
    public function createRoundOf16Fixtures($competitors, Competition $competition, Season $season)
    {
        $round = new Round();
        $round->setRound(1);
        $round->setName(RoundName::ROUND_OF_16);
        $startDate = clone $season->getStartDate();
        $round->setStartDate($startDate);

        $fixtures = [];
        while (count($competitors) > 0) {
            $randomWinnerRand = rand(0, count($competitors) - 1);
            $randomWinner1 = $competitors[$randomWinnerRand];
            unset($competitors[$randomWinnerRand]);

            $randomWinnerRand = rand(0, count($competitors) - 1);
            $randomWinner2 = $competitors[$randomWinnerRand];
            unset($competitors[$randomWinnerRand]);

            $fixtures[] = $this->matchService->createMatch($randomWinner1, $randomWinner2, $competition, $season, $round, true);
        }

        return $fixtures;
    }

    /**
     * @param Match $match
     * @return Match[]|void
     */
    public function createFixturesFromMatch(Match $match)
    {
        if (!$match->isConfirmed()) {
            return;
        }

        $fixtures = [];

        if ($match->getCompetition() instanceof Knockout) {
            $round = $match->getRound();
            $matchesFromRound = $this->matchService->getMatchesByRoundAndSeason($round, $match->getSeason());
            if ($this->matchService->haveAllMatchesBeenConfirmed($matchesFromRound)) {
                $fixtures = $this->createNextRoundFixtures($match);
            }
        } else {
            $stage = $match->getCompetition()->getStage();
            if ($stage instanceof GroupStage) {
                $matchesFromStage = $this->matchService->getMatchesByStageAndSeason($stage, $match->getSeason());
                if ($this->matchService->haveAllMatchesBeenConfirmed($matchesFromStage)) {
                    $fixtures = $this->createChampionsLeagueQuarterFinalFixtures($match);
                }
            }
        }

        return $fixtures;
    }

    public function createNextRoundFixtures(Match $match)
    {
        $matches = $this->matchService->getMatchesByRoundAndSeason($match->getRound(), $match->getSeason());

        $winners = [];
        foreach ($matches as $match) {
            $winners[] = $this->matchService->getWinner($match);
        }

        $round = new Round();
        $round->setRound($match->getRound()->getRound() + 1);
        if (count($winners) === 8) {
            $roundName = RoundName::QUARTER_FINAL;
        } else if (count($winners) === 4) {
            $roundName = RoundName::SEMI_FINAL;
        } else if (count($winners) === 2) {
            $roundName = RoundName::THE_FINAL;
        } else if (count($winners) === 1) {
            return;
        }
        $round->setName($roundName);
        $startDate = clone $match->getRound()->getStartDate()->add(new \DateInterval('P1D'));
        $round->setStartDate($startDate);

        $fixtures = [];
        while (count($winners) > 0) {
            $randomWinnerRand = rand(0, count($winners) - 1);
            $randomWinner1 = $winners[$randomWinnerRand];
            unset($winners[$randomWinnerRand]);

            $randomWinnerRand = rand(0, count($winners) - 1);
            $randomWinner2 = $winners[$randomWinnerRand];
            unset($winners[$randomWinnerRand]);

            $fixtures[] = $this->matchService->createMatch($randomWinner1, $randomWinner2, $match->getCompetition(), $match->getSeason(), $round, true);
        }

        return $fixtures;
    }

    /**
     * @param Match $match
     * @return Match[]
     */
    public function createChampionsLeagueQuarterFinalFixtures(Match $match)
    {
        /** @var GroupStage $stage */
        $stage = $match->getCompetition()->getStage();
        /** @var KnockoutStage $nextStage */
        $nextStage = $stage->getNextStage();
        $competitions = $stage->getCompetitions();

        /** @var Standing[] $standings */
        $standings = [];
        foreach ($competitions as $competition) {
            $standings[] = $this->standingService->getPromotedStandingsByCompetitionAndSeason($competition, $match->getSeason());
        }

        $winners = [];
        $winners[] = $standings[0]->getCompetitor();
        $winners[] = $standings[2]->getCompetitor();
        $winners[] = $standings[4]->getCompetitor();
        $winners[] = $standings[6]->getCompetitor();

        $runnerUps = [];
        $runnerUps[] = $standings[1]->getCompetitor();
        $runnerUps[] = $standings[3]->getCompetitor();
        $runnerUps[] = $standings[5]->getCompetitor();
        $runnerUps[] = $standings[7]->getCompetitor();

        $round = new Round();
        $round->setRound($match->getRound()->getRound() + 1);
        $round->setName(RoundName::QUARTER_FINAL);
        $startDate = clone $match->getRound()->getStartDate()->add(new \DateInterval('P1D'));
        $round->setStartDate($startDate);

        $fixtures = [];
        while (count($winners) > 0) {
            $randomWinnerRand = rand(0, count($winners) - 1);
            $randomWinner = $winners[$randomWinnerRand];
            unset($winners[$randomWinnerRand]);

            $randomRunnerUpRand = rand(0, count($runnerUps) - 1);
            $randomRunnerUp = $runnerUps[$randomRunnerUpRand];
            unset($runnerUps[$randomRunnerUpRand]);

            $fixtures[] = $this->matchService->createMatch($randomWinner, $randomRunnerUp, $nextStage->getCompetition(), $match->getSeason(), $round, true);
        }

        return $fixtures;
    }
}