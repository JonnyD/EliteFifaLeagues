<?php

namespace EliteFifa\AssociationBundle\Service;

use EliteFifa\AssociationBundle\Entity\Association;
use EliteFifa\AssociationBundle\Repository\AssociationRepository;

class AssociationService
{
    /**
     * @var AssociationRepository $associationRepository
     */
    private $associationRepository;

    /**
     * @param $associationRepository
     */
    public function __construct($associationRepository)
    {
        $this->associationRepository = $associationRepository;
    }

    /**
     * @param $name
     * @return Association
     */
    public function createAssociation($name)
    {
        $association = new Association();
        $association->setName($name);
        $this->persistAndFlush($association);
        return $association;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getAssociationByName($name)
    {
        return $this->associationRepository->findOneBy([
            'name' => $name
        ]);
    }

    /**
     * @param string $slug
     * @return Association
     */
    public function getAssociationBySlug($slug)
    {
        return $this->associationRepository->findOneBy([
           'slug' => $slug
        ]);
    }

    /**
     * @return Association[]
     */
    public function getAllAssociations()
    {
        return $this->associationRepository->findAll();
    }

    /**
     * @param Association $association
     * @param bool $sync
     */
    public function save(Association $association, bool $sync = true)
    {
        $this->associationRepository->save($association, $sync);
    }
}