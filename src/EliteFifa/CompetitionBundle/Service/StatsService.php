<?php

namespace EliteFifa\CompetitionBundle\Service;

use EliteFifa\Bundle\Entity\Competition;
use EliteFifa\Bundle\Entity\Season;
use EliteFifa\Bundle\Entity\Stats;
use EliteFifa\Bundle\Entity\Team;
use EliteFifa\Bundle\Repository\StatsRepository;
use Doctrine\ORM\EntityManager;

//todo SPECIFICATION / CRITERIA
class StatsService
{
    private $statsRepository;

    public function __construct(StatsRepository $statsRepository)
    {
        $this->statsRepository = $statsRepository;
    }

    public function getOrCreateStats(Team $team, Competition $competition, Season $season)
    {
        $stats = $this->getStatsByTeam($team);
        if ($stats == null) {
            $stats = $this->createStats($team, $competition, $season);
        }
        return $stats;
    }

    public function createStats(Team $team, Competition $competition, Season $season)
    {
        $stats = new Stats();
        $stats->setTeam($team);
        $stats->setCompetition($competition);
        $stats->setSeason($season);
        return $stats;
    }

    public function getStatsByTeam(Team $team)
    {
        return $this->statsRepository->findOneByTeam($team);
    }

    public function compareAndUpdateHighestWinStreak($currentWinStreak, $stats)
    {
        $oldWinStreak = $stats->getHighestWinStreak();
        if ($currentWinStreak > $oldWinStreak) {
            $stats->setHighestWinStreak($currentWinStreak);
        }
    }

    public function compareAndUpdateHighestLoseStreak($currentLoseStreak, $stats)
    {
        $oldLoseStreak = $stats->getHighestLossStreak();
        if ($currentLoseStreak > $oldLoseStreak) {
            $stats->setHighestLossStreak($currentLoseStreak);
        }
    }

    public function compareAndUpdateHighestDrawStreak($currentDrawStreak, $stats)
    {
        $oldDrawStreak = $stats->getHighestDrawStreak();
        if ($currentDrawStreak > $oldDrawStreak) {
            $stats->setHighestDrawStreak($currentDrawStreak);
        }
    }

    public function getHighestWinStreak($results)
    {
        $highestWinStreak = 0;
        $wins = 0;
        foreach ($results as $result) {
            if ($result->isWin()) {
                $wins++;

                if ($wins > $highestWinStreak) {
                    $highestWinStreak = $wins;
                }
            } else {
                $wins = 0;
            }
        }
        return $highestWinStreak;
    }

    public function getCurrentWinStreak($results)
    {
        $wins = 0;
        foreach ($results as $result) {
            if ($result->isWin()) {
                $wins++;
            } else {
                break;
            }
        }
        return $wins;
    }

    public function getHighestLoseStreak($results)
    {
        $highestLoseStreak = 0;
        $losses = 0;
        foreach ($results as $result) {
            if ($result->isLoss()) {
                $losses++;

                if ($losses > $highestLoseStreak) {
                    $highestLoseStreak = $losses;
                }
            } else {
                $losses = 0;
            }
        }
        return $highestLoseStreak;
    }

    public function getCurrentLoseStreak($results)
    {
        $losses = 0;
        foreach ($results as $result) {
            if ($result->isLoss()) {
                $losses++;
            } else {
                break;
            }
        }
        return $losses;
    }

    public function getHighestDrawStreak($results)
    {
        $highestDrawStreak = 0;
        $draws = 0;
        foreach ($results as $result) {
            if ($result->isDraw()) {
                $draws++;

                if ($draws > $highestDrawStreak) {
                    $highestDrawStreak = $draws;
                }
            } else {
                $draws = 0;
            }
        }
        return $highestDrawStreak;
    }

    public function getCurrentDrawStreak($results)
    {
        $draws = 0;
        foreach ($results as $result) {
            if ($result->isDraw()) {
                $draws++;
            } else {
                break;
            }
        }
        return $draws;
    }

    public function getHighestWithoutWinningStreak($results)
    {
        $highestStreak = 0;
        $games = 0;
        foreach ($results as $result) {
            if (!$result->isWin()) {
                $games++;

                if ($games > $highestStreak) {
                    $highestStreak = $games;
                }
            } else {
                $games = 0;
            }
        }
        return $highestStreak;
    }

    public function updateHighestWithoutWinningStreak($newStreak, $stats)
    {
        $oldStreak = $stats->getHighestWithoutWinningStreak();
        if ($newStreak > $oldStreak) {
            $stats->setHighestWithoutWinningStreak($newStreak);
        }
    }

    public function getCurrentWithoutWinningStreak($results)
    {
        $games = 0;
        foreach ($results as $result) {
            if (!$result->isWin()) {
                $games++;
            } else {
                break;
            }
        }
        return $games;
    }

    public function getCurrentWithoutLosingStreak($results)
    {
        $games = 0;
        foreach ($results as $result) {
            if (!$result->isLoss()) {
                $games ++;
            } else {
                break;
            }
        }
        return $games;
    }

    public function getHighestWithoutLosingStreak($results)
    {
        $highestStreak = 0;
        $games = 0;
        foreach ($results as $result) {
            if (!$result->isLoss()) {
                $games ++;

                if ($games > $highestStreak) {
                    $highestStreak = $games;
                }
            } else {
                $games = 0;
            }
        }
        return $highestStreak;
    }

    public function updateHighestWithoutLosingStreak($newStreak, $stats)
    {
        $oldStreak = $stats->getHighestWithoutLosingStreak();
        if ($newStreak > $oldStreak) {
            $stats->setHighestWithoutLosingStreak($newStreak);
        }
    }

    public function getCurrentWithoutConcedingStreak($results)
    {
        $games = 0;
        foreach ($results as $result) {
            $team = $result->getTeam();
            $match = $result->getMatch();

            if ($match->isHome($team)) {
                if ($match->getAwayScore() == 0) {
                    $games++;
                } else {
                    break;
                }
            } else if ($match->isAway($team)) {
                if ($match->getHomeScore() == 0) {
                    $games++;
                } else {
                    break;
                }
            }
        }
        return $games;
    }

    public function getHighestWithoutConcedingStreak($results)
    {
        $highestStreak = 0;
        $games = 0;
        foreach ($results as $result) {
            $team = $result->getTeam();
            $match = $result->getMatch();

            if ($match->isHome($team)) {
                if ($match->getAwayScore() == 0) {
                    $games++;
                } else {
                    $games = 0;
                }
            } else if ($match->isAway($team)) {
                if ($match->getHomeScore() == 0) {
                    $games++;
                } else {
                    break;
                }
            }

            if ($games > $highestStreak) {
                $highestStreak = $games;
            }
        }
        return $highestStreak;
    }

    public function updateHighestWithoutConcedingStreak($newStreak, $stats)
    {
        $oldStreak = $stats->getHighestWithoutConcedingStreak();
        if ($newStreak > $oldStreak) {
            $stats->setHighestWithoutConcedingStreak($newStreak);
        }
    }

    public function getCurrentWithoutScoringStreak($results)
    {
        $games = 0;
        foreach ($results as $result) {
            $team = $result->getTeam();
            $match = $result->getMatch();

            if ($match->isHome($team)) {
                if ($match->getHomeScore() == 0) {
                    $games++;
                } else {
                    break;
                }
            } else if ($match->isAway($team)) {
                if ($match->getAwayScore() == 0) {
                    $games++;
                } else {
                    break;
                }
            }
        }
        return $games;
    }

    public function getHighestWithoutScoringStreak($results)
    {
        $highestStreak = 0;
        $games = 0;
        foreach ($results as $result) {
            $team = $result->getTeam();
            $match = $result->getMatch();

            if ($match->isHome($team)) {
                if ($match->getHomeScore() == 0) {
                    $games++;
                } else {
                    $games = 0;
                }
            } else if ($match->isAway($team)) {
                if ($match->getAwayScore() == 0) {
                    $games++;
                } else {
                    $games = 0;
                }
            }

            if ($games > $highestStreak) {
                $highestStreak = $games;
            }
        }
        return $highestStreak;
    }

    public function updateHighestWithoutScoringStreak($newStreak, $stats)
    {
        $oldStreak = $stats->getHighestWithoutScoringStreak();
        if ($newStreak > $oldStreak) {
            $stats->setHighestWithoutScoringStreak($newStreak);
        }
    }

    public function getCurrentScoredStreak($results)
    {
        $games = 0;
        foreach ($results as $result) {
            $team = $result->getTeam();
            $match = $result->getMatch();

            if ($match->isHome($team)) {
                if ($match->getHomeScore() > 0) {
                    $games++;
                } else {
                    break;
                }
            } else if ($match->isAway($team)) {
                if ($match->getAwayScore() > 0) {
                    $games++;
                } else {
                    break;
                }
            }
        }
        return $games;
    }

    public function getHighestScoredStreak($results)
    {
        $highestStreak = 0;
        $games = 0;
        foreach ($results as $result) {
            $team = $result->getTeam();
            $match = $result->getMatch();

            if ($match->isHome($team)) {
                if ($match->getHomeScore() > 0) {
                    $games++;
                } else {
                    $games = 0;
                }
            } else if ($match->isAway($team)) {
                if ($match->getAwayScore() > 0) {
                    $games++;
                } else {
                    $games = 0;
                }
            }

            if ($games > $highestStreak) {
                $highestStreak = $games;
            }
        }
        return $highestStreak;
    }

    public function updateHighestScoredStreak($newStreak, $stats)
    {
        $oldStreak = $stats->getHighestScoredStreak();
        if ($newStreak > $oldStreak) {
            $stats->setHighestScoredStreak($newStreak);
        }
    }

    public function getTeamsByCurrentWinStreak(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'currentWinStreak');
    }

    public function getTeamsByCurrentDrawStreak(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'currentDrawStreak');
    }

    public function getTeamsByCurrentLossStreak(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'currentLossStreak');
    }

    public function getTeamsByCurrentWithoutWinningStreak(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'currentWithoutWinningStreak');
    }

    public function getTeamsByCurrentWithoutLosingStreak(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'currentWithoutLosingStreak');
    }

    public function getTeamsByCurrentWithoutConcedingStreak(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'currentWithoutConcedingStreak');
    }

    public function getTeamsByCurrentWithoutScoringStreak(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'currentWithoutScoringStreak');
    }

    public function getTeamsByCurrentScoredStreak(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'currentScoredStreak');
    }

    public function getTeamsByPlayed(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'played');
    }

    public function getTeamsByPoints(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'points');
    }

    public function getTeamsByWon(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'won');
    }

    public function getTeamsByLost(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'lost');
    }

    public function getTeamsByDrawn(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'drawn');
    }

    public function getTeamsByCombinedForm(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'currentCombinedFormPoints');
    }

    public function getTeamsByHomeForm(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'currentHomeFormPoints');
    }

    public function getTeamsByAwayForm(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'currentAwayFormPoints');
    }

    public function getTeamsByScored(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'scored');
    }

    public function getTeamsByConceded(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'conceded');
    }

    public function getTeamsByYellows(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'yellows');
    }

    public function getTeamsByReds(Competition $competition, Season $season)
    {
        return $this->getTeamsByCompetitionAndSeason($competition, $season, 'reds');
    }

    public function getBiggestWinByCompetitionAndSeason(Competition $competition, Season $season)
    {
        return $this->statsRepository->findBiggestWinByCompetitionAndSeason($competition, $season);
    }

    public function getBiggestWinByCompetition(Competition $competition)
    {
        return $this->statsRepository->findBiggestWinByCompetition($competition);
    }

    public function getHighestScoringMatchByCompetitionAndSeason(Competition $competition, Season $season)
    {
        return $this->statsRepository->findHighestScoringMatchByCompetitionAndSeason($competition, $season);
    }

    public function getTeamWithHighestWithoutWinningStreak(Competition $competition, $season)
    {
        return $this->getTeamByCompetitionAndSeasonAndField($competition, $season, 'highestWithoutWinningStreak');
    }

    public function getTeamWithHighestWithoutLosingStreak(Competition $competition, Season $season)
    {
        return $this->getTeamByCompetitionAndSeasonAndField($competition, $season, 'highestWithoutLosingStreak');
    }

    public function getTeamWithHighestWithoutScoringStreak(Competition $competition, Season $season)
    {
        return $this->getTeamByCompetitionAndSeasonAndField($competition, $season, 'highestWithoutScoringStreak');
    }

    public function getTeamWithHighestScoredStreak(Competition $competition, Season $season)
    {
        return $this->getTeamByCompetitionAndSeasonAndField($competition, $season, 'highestScoredStreak');
    }

    public function getTeamWithMostLosses(Competition $competition, Season $season)
    {
        return $this->getTeamByCompetitionAndSeasonAndField($competition, $season, 'lost');
    }

    public function getTeamWithMostPoints(Competition $competition, Season $season)
    {
        return $this->getTeamByCompetitionAndSeasonAndField($competition, $season, 'points');
    }

    public function getTeamWithMostWins(Competition $competition, Season $season)
    {
        return $this->getTeamByCompetitionAndSeasonAndField($competition, $season, 'won');
    }

    public function getTeamWithMostDraws(Competition $competition, Season $season)
    {
        return $this->getTeamByCompetitionAndSeasonAndField($competition, $season, 'drawn');
    }

    private function getTeamByCompetitionAndSeasonAndField(Competition $competition, Season $season, $orderBy)
    {
        return $this->statsRepository->findOneBy(
            array(
                'competition' => $competition,
                'season' => $season
            ),
            array($orderBy => 'DESC'),
            1
        );
    }

    private function getTeamsByCompetitionAndSeason(Competition $competition, Season $season, $orderBy)
    {
        return $this->statsRepository->findBy(
            array(
                'competition' => $competition,
                'season' => $season
            ),
            array($orderBy => 'DESC')
        );
    }
}