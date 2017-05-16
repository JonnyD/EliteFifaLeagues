<?php

namespace EliteFifa\AssociationBundle\Controller;

use EliteFifa\AssociationBundle\Service\AssociationService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AssociationController extends Controller
{
    public function showWorldAction()
    {
        $associationManager = $this->getAssociationService();
        $association = $associationManager->getAssociationByName("World");

        return $this->render('EliteFifaBundle:Association:show.html.twig', [
            'association' => $association
        ]);
    }

    /**
     * @return AssociationService
     */
    private function getAssociationService()
    {
        return $this->container->get("elite_fifa.association_service");
    }
}