<?php

namespace EliteFifa\SeasonBundle\Controller;

use EliteFifa\AssociationBundle\Service\AssociationService;
use EliteFifa\CompetitorBundle\Service\CompetitorService;
use EliteFifa\MatchBundle\Enum\MatchStatus;
use EliteFifa\MatchBundle\Service\MatchService;
use EliteFifa\RegionBundle\Service\RegionService;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\SeasonBundle\Enum\RenewalType;
use EliteFifa\SeasonBundle\Enum\SeasonStatus;
use EliteFifa\SeasonBundle\Service\SeasonService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class AdminSeasonController extends Controller
{
    public function createAction(Request $request)
    {
        $season = new Season();

        $regionId = $request->query->get('regionId');
        if ($regionId != null) {
            $regionService = $this->getRegionService();
            $region = $regionService->getRegionById($regionId);
            if ($region == null) {
                throw new \Exception("Region not found");
            }
            $season->setRegion($region);
        }

        $renewalTypes = [];
        foreach (RenewalType::getLabels() as $label) {
            $renewalTypes[$label] = RenewalType::getKey($label);
        }
        $form = $this->createFormBuilder($season)
            ->add('number', TextType::class)
            ->add('startDate', DateTimeType::class, [
                'placeholder' => array(
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                    'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                )
            ])
            ->add('endDate', DateTimeType::class, [
                'placeholder' => array(
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                    'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                )
            ])
            ->add('renewalType', ChoiceType::class, [
                'choices' => $renewalTypes,
                'label' => 'Renewal Type'
            ])
            ->add('save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $season = $form->getData();

            $seasonService = $this->getSeasonService();
            $season->setStatus(SeasonStatus::NEW_SEASON);
            $seasonService->save($season);

            return $this->redirectToRoute('elite_fifa.admin_show_season', [
                'id' => $season->getId()
            ]);
        }

        return $this->render('SeasonBundle:AdminSeason:create.html.twig', [
            'season' => $season,
            'form' => $form->createView()
        ]);
    }

    public function showAction(int $number)
    {
        $seasonService = $this->getSeasonService();
        $season = $seasonService->getSeasonByNumber($number);

        if ($season == null) {
            throw new \Exception("This season does not exist");
        }

        return $this->render('SeasonBundle:AdminSeason:show.html.twig', [
            'season' => $season
        ]);
    }

    public function endAction(Request $request, $id)
    {
        $seasonService = $this->getSeasonService();
        $season = $seasonService->getSeasonById($id);

        if (!$season->isInProgress()) {
            throw new \Exception("Season not in progress");
        }

        $matchService = $this->getMatchService();
        $reportedMatches = $matchService->getAllMatchesBySeasonAndStatus($season, MatchStatus::REPORTED);
        $unPlayedMatches = $matchService->getAllMatchesBySeasonAndStatus($season, MatchStatus::UNPLAYED);

        if (count($reportedMatches) > 0 || count($unPlayedMatches) > 0) {
            throw new \Exception("There are some matches not confirmed");
        }

        $season->setStatus(SeasonStatus::FINISHED);
        $seasonService->save($season);
    }

    /**
     * @return SeasonService
     */
    private function getSeasonService()
    {
        return $this->get('elite_fifa.season_service');
    }

    /**
     * @return MatchService
     */
    private function getMatchService()
    {
        return $this->get('elite_fifa.match_service');
    }

    /**
     * @return CompetitorService
     */
    private function getCompetitorService()
    {
        return $this->get('elite_fifa.competitor_service');
    }

    /**
     * @return RegionService
     */
    private function getRegionService()
    {
        return $this->get('elite_fifa.region_service');
    }
}