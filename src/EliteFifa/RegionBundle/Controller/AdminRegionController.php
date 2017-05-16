<?php

namespace EliteFifa\RegionBundle\Controller;

use EliteFifa\RegionBundle\Entity\Region;
use EliteFifa\RegionBundle\Service\RegionService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class AdminRegionController extends Controller
{
    public function listAction()
    {
        $regionService = $this->getRegionService();
        $regions = $regionService->getAllRegions();

        return $this->render('RegionBundle:AdminRegion:list.html.twig', [
            'regions' => $regions
        ]);
    }

    public function showAction($slug)
    {
        $regionService = $this->getRegionService();
        $region = $regionService->getRegionBySlug($slug);

        return $this->render('RegionBundle:AdminRegion:show.html.twig', [
            'region' => $region
        ]);
    }

    public function createAction(Request $request)
    {
        $region = new Region();

        $form = $this->createFormBuilder($region)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $region = $form->getData();

            $regionService = $this->getRegionService();
            $regionService->save($region);

            return $this->redirectToRoute('elite_fifa.admin_show_region', [
                'slug' => $region->getSlug()
            ]);
        }

        return $this->render('RegionBundle:AdminRegion:create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @return RegionService
     */
    private function getRegionService()
    {
        return $this->get('elite_fifa.region_service');
    }
}