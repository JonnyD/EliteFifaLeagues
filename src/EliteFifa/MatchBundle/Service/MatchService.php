<?php

namespace EliteFifa\MatchBundle\Service;

use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\MatchBundle\Criteria\MatchCriteria;
use EliteFifa\MatchBundle\Entity\Round;
use EliteFifa\MatchBundle\Enum\MatchStatus;
use EliteFifa\MatchBundle\Event\MatchEvent;
use EliteFifa\MatchBundle\Event\MatchEvents;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\MatchBundle\Repository\MatchRepository;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\TeamBundle\Entity\Team;
use EliteFifa\UserBundle\Entity\User;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactory;

//todo
class MatchService
{
    /**
     * @var MatchRepository
     */
    private $matchRepository;

    /**
     * @var FormFactory
     */
    private $formFactory;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param MatchRepository $matchRepository
     * @param FormFactory $formFactory
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        MatchRepository $matchRepository,
        FormFactory $formFactory,
        EventDispatcherInterface $eventDispatcher)
    {
        $this->matchRepository = $matchRepository;
        $this->formFactory = $formFactory;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param Match $match
     */
    public function confirm(Match $match)
    {
        $match->setConfirmed(new \DateTime());
        $this->save($match);
    }

    /**
     * @param Competitor $competitor
     * @return Match[]
     */
    public function getHomeMatchesByCompetitor(Competitor $competitor)
    {
        $criteria = new MatchCriteria();
        $criteria->setHomeCompetitor($competitor);

        $matches = $this->matchRepository->findMatchesByCriteria($criteria);
        return $matches;
    }

    /**
     * @param Competitor $competitor
     * @return Match[]
     */
    public function getAwayMatchesByCompetitor(Competitor $competitor)
    {
        $criteria = new MatchCriteria();
        $criteria->setAwayCompetitor($competitor);

        $matches = $this->matchRepository->findMatchesByCriteria($criteria);
        return $matches;
    }

    /**
     * @param Competitor $homeCompetitor
     * @param Competitor $awayCompetitor
     * @param Competition $competition
     * @param Season $season
     * @param Round $round
     * @return Match
     */
    public function createMatch(
        Competitor $homeCompetitor, Competitor $awayCompetitor,
        Competition $competition,
        Season $season, Round $round)
    {
        $match = new Match();
        $match->setHomeCompetitor($homeCompetitor);
        $match->setAwayCompetitor($awayCompetitor);
        if ($homeCompetitor->getTeam()) {
            $match->setHomeTeam($homeCompetitor->getTeam());
        }
        if ($awayCompetitor->getTeam()) {
            $match->setAwayTeam($awayCompetitor->getTeam());
        }
        if ($homeCompetitor->getUser()) {
            $match->setHomeUser($homeCompetitor->getUser());
        }
        if ($awayCompetitor->getUser()) {
            $match->setAwayUser($awayCompetitor->getUser());
        }
        $match->setRound($round);
        $match->setSeason($season);
        $match->setCompetition($competition);
        $match->setStatus(MatchStatus::UNPLAYED);

        return $match;
    }

    public function createLadderMatch(Team $homeTeam, Team $awayTeam,
                                User $homeUser, User $awayUser,
                                Competition $competition, Season $season)
    {
        $match = new Match();
        $match->setHomeTeam($homeTeam);
        $match->setAwayTeam($awayTeam);
        $match->setHomeUser($homeUser);
        $match->setAwayUser($awayUser);
        $match->setSeason($season);
        $match->setCompetition($competition);
        return $match;
    }

    public function getAllMatches()
    {
        return $this->matchRepository->findAll();
    }

    public function getMatchesByUser($user)
    {
        return $this->matchRepository->findMatchesByUser($user);
    }

    public function getResultsByUser($user)
    {
        return $this->matchRepository->findResultsByUser($user);
    }

    public function getAllMatchesByTeam($team)
    {
        return $this->matchRepository->findMatchesByTeam($team);
    }

    public function getHomeMatchesByTeam($team)
    {
        return $this->matchRepository->findHomeMatchesByTeam($team);
    }

    public function getAwayMatchesByTeam($team)
    {
        return $this->matchRepository->findAwayMatchesByTeam($team);
    }

    public function getMatchesByTeamCompetitionSeason($team, $competition, $season)
    {
        return $this->matchRepository->findMatchesByTeamCompetitionSeason($team, $competition, $season);
    }

    public function getConfirmedMatchesByTeamCompetitionSeasonOrderedByConfirmedDesc($team, $competition, $season)
    {
        return $this->matchRepository->findConfirmedMatchesByTeamCompetitionSeasonOrderedByConfirmedDesc($team, $competition, $season);
    }

    public function getUnreportedMatches()
    {
        return $this->matchRepository->findUnreportedMatches();
    }

    /**
     * @param int $id
     * @return null|Match
     */
    public function getMatchById(int $id)
    {
        return $this->matchRepository->find($id);
    }

    public function getLast5MatchesPlayedByTeam($team)
    {
        return $this->matchRepository->findLast5MatchesPlayed($team);
    }

    public function calculateResultType($match, $selectedTeam)
    {
        $homeTeam = $match->getHomeTeam();
        $awayTeam = $match->getAwayTeam();
        $homeScore = $match->getHomeScore();
        $awayScore = $match->getAwayScore();

        $resultType = "";
        if ($selectedTeam == $homeTeam) {
            if ($homeScore > $awayScore) {
                $resultType = "W";
            } else if ($homeScore < $awayScore) {
                $resultType = "";
            } else if ($homeScore == $awayScore) {
                $resultType = "";
            }
        } else if ($selectedTeam == $awayTeam) {
            if ($homeScore > $awayScore) {
                $resultType = "";
            } else if ($homeScore < $awayScore) {
                $resultType = "";
            } else if ($homeScore == $awayScore) {
                $resultType = "";
            }
        }

        return $resultType;
    }

    public function getMatchesByCompetitionSeasonOrderedByRound($competition, $season)
    {
        return $this->matchRepository->findMatchesByCompetitionSeasonOrderedByRound($competition, $season);
    }

    public function getMatchesByCompetitionAndSeason($competition, $season)
    {
        return $this->matchRepository->findMatchesForCompetitionBySeason($competition, $season);
    }

    public function getMatchesForCompetitionBySeasonAndRound($competition, $season, $round)
    {
        return $this->matchRepository->findMatchesForCompetitionBySeasonAndRound($competition, $season, $round);
    }

    public function getNumberOfRoundsByCompetitionAndSeason($competition, $season)
    {
        return $this->matchRepository->findNumberOfRoundsByCompetitionAndSeason($competition, $season);
    }

    public function getAmountOfMatchesByCompetitionAndSeason($competition, $season)
    {
        return $this->matchRepository->findAmountOfMatchesByCompetitionAndSeason($competition, $season);
    }

    public function getAmountOfMatchesPlayedByCompetitionAndSeason($competition, $season)
    {
        return $this->matchRepository->findAmountOfMatchesPlayedByCompetitionAndSeason($competition, $season);
    }

    public function getAmountOfHomeWinsByCompetitionAndSeason($competition, $season)
    {
        return $this->matchRepository->findAmountOfHomeWinsByCompetitionAndSeason($competition, $season);
    }

    public function getAmountOfAwayWinsByCompetitionAndSeason($competition, $season)
    {
        return $this->matchRepository->findAmountOfAwayWinsByCompetitionAndSeason($competition, $season);
    }

    public function getAmountOfDrawsByCompetitionAndSeason($competition, $season)
    {
        return $this->matchRepository->findAmountOfDrawsByCompetitionAndSeason($competition, $season);
    }

    public function getAmountOfGoalsByCompetitionAndSeason($competition, $season)
    {
        return $this->matchRepository->findAmountOfGoalsByCompetitionAndSeason($competition, $season);
    }

    public function getAmountBothTeamsScoredByCompetitionAndSeason($competition, $season)
    {
        return $this->matchRepository->findAmountBothTeamsScoredByCompetitionAndSeason($competition, $season);
    }

    public function getAverageGoalsPerMatchByCompetitionAndSeason($competition, $season)
    {
        return $this->matchRepository->findAverageGoalsPerMatchByCompetitionAndSeason($competition, $season);
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
        for ($r = 0; $r < $roundsCount; $r++) {
            for ($j = 0; $j < count($home); $j++) {
                $rounds[$r][$j]["Home"] = $home[$j];
                $rounds[$r][$j]["Away"] = $away[$j];
            }
            if (count($home) + count($away) -1 > 2) {
                array_unshift($away, current(array_splice($home, 1, 1)));
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

            foreach ($m as $j => $match) {
                /** @var Competitor $homeCompetitor */
                $homeCompetitor = $match['Home'];
                /** @var Competitor $awayCompetitor */
                $awayCompetitor = $match['Away'];

                $fixtures[] = $this->createMatch($homeCompetitor, $awayCompetitor, $competition, $season, $round);
            }

            $roundNumber++;
        }

        return $fixtures;
    }

    public function updateMatch(Match $match, $homeScore, $awayScore, $reported, $confirmed)
    {
        $match->setHomeScore($homeScore);
        $match->setAwayScore($awayScore);
        $match->setReported($reported);
        $match->setConfirmed($confirmed);
    }

    public function getSelectedRound($round)
    {
        if ($round != null) {
            $selectedRound = $round;
        } else {
            $selectedRound = 1;
        }
        return $selectedRound;
    }

    public function createSelectRoundDropDown(Competition $competition, Season $season, $currentRound, $action)
    {
        $rounds = $this->getNumberOfRoundsByCompetitionAndSeason($competition, $season);
        $roundChoices = array();
        for ($i = 1; $i <= $rounds; $i++) {
            $roundChoices[$i] = $i;
        }

        $selectRoundForm = $this->formFactory->createBuilder()
            ->setAction($action)
            ->setMethod("GET")
            ->add('select_round', 'choice', array(
                'choices' => $roundChoices,
                'label' => 'Round ',
                'data' => $currentRound
            ))
            ->getForm();

        return $selectRoundForm;
    }

    public function getResultCode(Team $selectedTeam, Match $match)
    {
        $homeTeam = $match->getHomeTeam();
        $awayTeam = $match->getAwayTeam();
        $homeScore = $match->getHomeScore();
        $awayScore = $match->getAwayScore();

        $resultCode = "";
        if ($selectedTeam == $homeTeam) {
            if ($homeScore > $awayScore) {
                $resultCode = "W";
            } else if ($homeScore < $awayScore) {
                $resultCode = "L";
            } else if ($homeScore == $awayScore) {
                $resultCode = "D";
            }
        } else if ($selectedTeam == $awayTeam) {
            if ($homeScore > $awayScore) {
                $resultCode = "L";
            } else if ($homeScore < $awayScore) {
                $resultCode = "W";
            } else if ($homeScore == $awayScore) {
                $resultCode = "D";
            }
        }

        return $resultCode;
    }

    public function getFormByTeam(Team $team)
    {
        $last5MatchesPlayed = $this->getLast5MatchesPlayedByTeam($team);
        $form = array();
        foreach ($last5MatchesPlayed as $match) {
            $resultCode = $this->getResultCode($team, $match);
            $formItem = array();
            $formItem["result"] = $resultCode;
            $formItem["match"] = $match;
            $form[] = $formItem;
        }
        return $form;
    }

    public function getMatchXMatchesAgoForTeam($team, $ago, $competition, $season)
    {
        return $this->matchRepository->findMatchXMatchesAgoForTeam($team, $ago, $competition, $season);
    }

    public function getLastXMatchesPlayed($team, $x)
    {
        return $this->matchRepository->findLastXMatchesPlayed($team, $x);
    }

    /**
     * @param Season $season
     * @param string $status
     * @return Match[]
     */
    public function getAllMatchesBySeasonAndStatus(Season $season, string $status)
    {
        return $this->matchRepository->findAllBySeasonAndStatus($season, $status);
    }

    /**
     * @param Match $match
     * @param bool $sync
     */
    public function save(Match $match, bool $sync = true)
    {
        $this->matchRepository->save($match, $sync);
    }

    /**
     * @param Match[] $matches
     */
    public function saveAll(array $matches)
    {
        foreach ($matches as $match) {
            $this->save($match, false);
        }
        $this->matchRepository->flush();
    }
}