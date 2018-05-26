<?php

namespace EliteFifa\MatchBundle\Service;

use Doctrine\Common\Collections\ArrayCollection;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitionBundle\Entity\GroupStage;
use EliteFifa\CompetitionBundle\Entity\Knockout;
use EliteFifa\CompetitionBundle\Entity\KnockoutStage;
use EliteFifa\CompetitionBundle\Entity\Stage;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\MatchBundle\Criteria\MatchCriteria;
use EliteFifa\MatchBundle\Entity\Round;
use EliteFifa\MatchBundle\Enum\MatchStatus;
use EliteFifa\MatchBundle\Enum\ResultCode;
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
     * @param MatchRepository $matchRepository
     * @param FormFactory $formFactory
     */
    public function __construct(
        MatchRepository $matchRepository,
        FormFactory $formFactory)
    {
        $this->matchRepository = $matchRepository;
        $this->formFactory = $formFactory;
    }

    /**
     * @param Match $match
     */
    public function confirm(Match $match)
    {
        $match->setConfirmed(new \DateTime());
        $match->setStatus(MatchStatus::CONFIRMED);
        $this->save($match);
    }

    /**
     * @param Stage $stage
     * @param Season $season
     * @return ArrayCollection|Match[]
     */
    public function getMatchesByStageAndSeason(Stage $stage, Season $season)
    {
        return $this->matchRepository->findMatchesByStageAndSeason($stage, $season);
    }

    /**
     * @param Match[] $matches
     * @return bool
     */
    public function haveAllMatchesBeenConfirmed($matches)
    {
        $allConfirmed = true;

        foreach ($matches as $match) {
            if (!$match->isConfirmed()) {
                $allConfirmed = false;
                break;
            }
        }

        return $allConfirmed;
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
     * @param bool $ranking
     * @return Match
     */
    public function createMatch(
        Competitor $homeCompetitor, Competitor $awayCompetitor,
        Competition $competition,
        Season $season, Round $round,
        bool $ranking)
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
        $match->setRanking($ranking);

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

    /**
     * @param Match $match
     * @param Competitor $competitor
     */
    public function simulateMatch(Match $match, Competitor $competitor)
    {
        $isHome = $match->isHome($competitor);
        $isAway = $match->isAway($competitor);

        if ($match->getCompetition() instanceof Knockout) {
            if ($isHome) {
                $match->setHomeScore(0);
                $match->setAwayScore(1);
            } else if ($isAway) {
                $match->setHomeScore(1);
                $match->setAwayScore(0);
            }
        } else {
            $match->setHomeScore(0);
            $match->setAwayScore(0);
        }

        $match->setReportedToNow();
        $match->setSimulated(true);

        $this->confirm($match);
    }

    /**
     * @return Match[]
     */
    public function getAllMatches()
    {
        return $this->matchRepository->findAll();
    }

    /**
     * @param Round $round
     * @param Season $season
     * @return Match[]
     */
    public function getMatchesByRoundAndSeason(Round $round, Season $season)
    {
        $criteria = new MatchCriteria();
        $criteria->setRound($round);
        $criteria->setSeason($season);

        return $this->matchRepository->findMatchesByCriteria($criteria);
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

    /**
     * @param Team $selectedTeam
     * @param Match $match
     * @return string
     */
    public function getResultCode(Team $selectedTeam, Match $match)
    {
        $homeTeam = $match->getHomeTeam();
        $awayTeam = $match->getAwayTeam();
        $homeScore = $match->getHomeScore();
        $awayScore = $match->getAwayScore();

        $resultCode = "";
        if ($selectedTeam === $homeTeam) {
            if ($homeScore > $awayScore) {
                $resultCode = ResultCode::WIN;
            } else if ($homeScore < $awayScore) {
                $resultCode = ResultCode::LOSS;
            } else if ($homeScore == $awayScore) {
                $resultCode = ResultCode::DRAW;
            }
        } else if ($selectedTeam === $awayTeam) {
            if ($homeScore > $awayScore) {
                $resultCode = ResultCode::LOSS;
            } else if ($homeScore < $awayScore) {
                $resultCode = ResultCode::WIN;
            } else if ($homeScore == $awayScore) {
                $resultCode = ResultCode::DRAW;
            }
        }

        return $resultCode;
    }

    /**
     * @param Match $match
     * @return Competitor|null
     */
    public function getWinner(Match $match)
    {
        $homeTeam = $match->getHomeCompetitor()->getTeam();
        $awayTeam = $match->getAwayCompetitor()->getTeam();

        if ($this->getResultCode($homeTeam, $match) === ResultCode::WIN) {
            return $match->getHomeCompetitor();
        } else if ($this->getResultCode($awayTeam, $match) === ResultCode::WIN) {
            return $match->getAwayCompetitor();
        } else {
            return null;
        }
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