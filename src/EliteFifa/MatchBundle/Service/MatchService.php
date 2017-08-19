<?php

namespace EliteFifa\MatchBundle\Service;

use Doctrine\Common\Collections\ArrayCollection;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\MatchBundle\Criteria\MatchCriteria;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\MatchBundle\Repository\MatchRepository;
use Doctrine\ORM\EntityManager;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\TeamBundle\Entity\Team;
use EliteFifa\UserBundle\Entity\User;
use EliteFifa\CompetitionBundle\Entity\Tournament;
use Symfony\Component\Form\FormFactory;

//todo
class MatchService
{
    /**
     * @var MatchRepository $matchRepository
     */
    private $matchRepository;
    private $formFactory;

    /**
     * @param MatchRepository $matchRepository
     * @param FormFactory $formFactory
     */
    public function __construct(MatchRepository $matchRepository,
                                FormFactory $formFactory)
    {
        $this->matchRepository = $matchRepository;
        $this->formFactory = $formFactory;
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

    public function createMatch(Team $homeTeam,
                                Team $awayTeam,
                                User $homeUser,
                                User $awayUser,
                                Competition $competition,
                                Season $season,
                                $round)
    {
        $match = new Match();
        $match->setHomeTeam($homeTeam);
        $match->setAwayTeam($awayTeam);
        $match->setHomeUser($homeUser);
        $match->setAwayUser($awayUser);
        $match->setRound($round);
        $match->setSeason($season);
        $match->setCompetition($competition);

        //$this->persistAndFlush($match);

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

    public function getMatchById($id)
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
     * @param $participants
     * @param Competition $competition
     * @param Season $season
     * @return Match[]
     */
    public function createFixtures($participants, Competition $competition, Season $season)
    {
        $fixtures = [];

        $teamsCount = count($participants);
        $rounds = $teamsCount - 1;
        $matchesPerRound = $teamsCount / 2;

        $awayTeams = array_splice($participants, $matchesPerRound);
        $homeTeams = $participants;

        for ($r = 0; $r < $rounds; $r++) {
            for ($m = 0; $m < $matchesPerRound; $m++) {
                $homeParticipant = $homeTeams[$m];
                $awayParticipant = $awayTeams[$m];

                $homeTeam = $homeParticipant->getTeam();
                $awayTeam = $awayParticipant->getTeam();

                $homeUser = $homeTeam->getUser();
                $awayUser = $awayTeam->getUser();

                $firstLeg = $this->createMatch($homeTeam, $awayTeam, $homeUser, $awayUser, $competition, $season, $r + 1);
                $secondLeg = $this->createMatch($awayTeam, $homeTeam, $awayUser, $homeUser, $competition, $season, $r + $rounds + 1);

                $fixtures[] = $firstLeg;
                //$this->persist($secondLeg);
            }
            $spliced = array_splice($homeTeams, 1, 1);
            $secondHomeTeam = array_shift($spliced);
            array_unshift($awayTeams, $secondHomeTeam);

            $lastAwayTeam = array_pop($awayTeams);
            array_push($homeTeams, $lastAwayTeam);
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
}