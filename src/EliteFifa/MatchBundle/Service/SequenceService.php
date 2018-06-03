<?php

namespace EliteFifa\MatchBundle\Service;

use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\MatchBundle\Criteria\SequenceCriteria;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\MatchBundle\Entity\Sequence;
use EliteFifa\MatchBundle\Enum\SequenceType;
use EliteFifa\MatchBundle\Repository\SequenceRepository;
use EliteFifa\SeasonBundle\Entity\Season;

class SequenceService
{
    /**
     * @var SequenceRepository
     */
    private $sequenceRepository;

    /**
     * @var MatchService
     */
    private $matchService;

    /**
     * @param SequenceRepository $sequenceRepository
     * @param MatchService $matchService
     */
    public function __construct(
        SequenceRepository $sequenceRepository,
        MatchService $matchService)
    {
        $this->sequenceRepository = $sequenceRepository;
        $this->matchService = $matchService;
    }

    /**
     * @param Competitor[] $competitors
     * @param Competition $competition
     * @param Season $season
     * @return Sequence[]
     */
    public function createOverallSequencesForCompetitors(array $competitors, Competition $competition, Season $season)
    {
        $sequences = [];

        foreach ($competitors as $competitor) {
            $sequence = new Sequence();
            $sequence->setSequenceType(SequenceType::OVERALL);
            $sequence->setCompetitor($competitor);
            $sequence->setCompetition($competition);
            $sequence->setSeason($season);

            $sequences[] = $sequence;
        }

        return $sequences;
    }

    /**
     * @param Competitor[] $competitors
     * @param Competition $competition
     * @param Season $season
     * @return Sequence[]
     */
    public function createHomeSequencesForCompetitors(array $competitors, Competition $competition, Season $season)
    {
        $sequences = [];

        foreach ($competitors as $competitor) {
            $sequence = new Sequence();
            $sequence->setSequenceType(SequenceType::HOME);
            $sequence->setCompetitor($competitor);
            $sequence->setCompetition($competition);
            $sequence->setSeason($season);

            $sequences[] = $sequence;
        }

        return $sequences;
    }

    /**
     * @param Competitor[] $competitors
     * @param Competition $competition
     * @param Season $season
     * @return Sequence[]
     */
    public function createAwaySequencesForCompetitors(array $competitors, Competition $competition, Season $season)
    {
        $sequences = [];

        foreach ($competitors as $competitor) {
            $sequence = new Sequence();
            $sequence->setSequenceType(SequenceType::AWAY);
            $sequence->setCompetitor($competitor);
            $sequence->setCompetition($competition);
            $sequence->setSeason($season);

            $sequences[] = $sequence;
        }

        return $sequences;
    }

    public function updateSequenceByMatch(Match $match)
    {
        $criteria = new SequenceCriteria();
        $criteria->setCompetition($match->getCompetition());
        $criteria->setSeason($match->getSeason());
        $criteria->setSequenceType(SequenceType::OVERALL);
        $criteria->setCompetitor($match->getHomeCompetitor());

        $homeOverallSequence = $this->sequenceRepository->findSequenceByCriteria($criteria);
        $this->updateSequence($homeOverallSequence, $match, $match->getHomeCompetitor());

        $criteria->setSequenceType(SequenceType::HOME);
        $homeHomeSequence = $this->sequenceRepository->findSequenceByCriteria($criteria);
        $this->updateSequence($homeHomeSequence, $match, $match->getHomeCompetitor());

        $criteria->setSequenceType(SequenceType::OVERALL);
        $criteria->setCompetitor($match->getAwayCompetitor());
        $awayOverallSequence = $this->sequenceRepository->findSequenceByCriteria($criteria);
        $this->updateSequence($awayOverallSequence, $match, $match->getAwayCompetitor());

        $criteria->setSequenceType(SequenceType::AWAY);
        $awayAwaySequence = $this->sequenceRepository->findSequenceByCriteria($criteria);
        $this->updateSequence($awayAwaySequence, $match, $match->getAwayCompetitor());

        $this->save($homeOverallSequence);
        $this->save($homeHomeSequence);
        $this->save($awayOverallSequence);
        $this->save($awayAwaySequence);
    }

    public function updateSequence(Sequence $sequence, Match $match, Competitor $competitor)
    {
        $hasWon = $this->matchService->hasWon($match, $competitor);
        $hasDrawn = $this->matchService->hasDrawn($match, $competitor);
        $hasLost = $this->matchService->hasLost($match, $competitor);
        $hasGoalsFor = $this->matchService->hasGoalsFor($match, $competitor);
        $hasGoalsAgainst = $this->matchService->hasGoalsAgainst($match, $competitor);

        if ($hasWon) {
            if ($sequence->getWins() == null) {
                $sequence->setWins(1);
            } else {
                $sequence->incrementWins();
            }
            $sequence->setDraws(null);
            $sequence->setLosses(null);
            $sequence->setWithoutWins(null);
            $sequence->incrementWithoutDraws();
            $sequence->incrementWithoutLosses();
        } else if ($hasDrawn) {
            if ($sequence->getDraws() == null) {
                $sequence->setDraws(1);
            } else {
                $sequence->incrementDraws();
            }
            $sequence->setWins(null);
            $sequence->setLosses(null);
            $sequence->setWithoutDraws(null);
            $sequence->incrementWithoutWins();
            $sequence->incrementWithoutLosses();
        } else if ($hasLost) {
            if ($sequence->getLosses() == null) {
                $sequence->setLosses(1);
            } else {
                $sequence->incrementLosses();
            }
            $sequence->setWins(null);
            $sequence->setDraws(null);
            $sequence->incrementWithoutWins();
            $sequence->incrementWithoutDraws();
        }

        if (!$hasGoalsFor) {
            if ($sequence->getWithoutGoalsFor() == null) {
                $sequence->setWithoutGoalsFor(1);
            } else {
                $sequence->incrementWithoutGoalsFor();
            }
        }

        if (!$hasGoalsAgainst) {
            if ($sequence->getWithoutGoalsAgainst() == null) {
                $sequence->setWithoutGoalsAgainst(1);
            } else {
                $sequence->incrementWithoutGoalsAgainst();
            }
        }
    }

    /**
     * @param Sequence $sequence
     * @param bool $sync
     */
    public function save(Sequence $sequence, bool $sync = true)
    {
        $this->sequenceRepository->save($sequence, $sync);
    }

    /**
     * @param Sequence[] $sequences
     */
    public function saveAll(array $sequences)
    {
        foreach ($sequences as $sequence) {
            $this->save($sequence, false);
        }
        $this->sequenceRepository->flush();
    }
}