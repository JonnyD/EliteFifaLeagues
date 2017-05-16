<?php

namespace EliteFifa\RegionBundle\Service;

use EliteFifa\RegionBundle\Entity\Region;
use EliteFifa\RegionBundle\Repository\RegionRepository;

class RegionService
{
    /**
     * @var RegionRepository
     */
    private $regionRepository;

    public function __construct(RegionRepository $regionRepository)
    {
        $this->regionRepository = $regionRepository;
    }

    /**
     * @return Region[]
     */
    public function getAllRegions()
    {
        return $this->regionRepository->findAll();
    }

    /**
     * @param int $id
     * @return Region
     */
    public function getRegionById(int $id)
    {
        return $this->regionRepository->find($id);
    }

    /**
     * @param string $slug
     * @return Region
     */
    public function getRegionBySlug(string $slug)
    {
        return $this->regionRepository->findOneBy([
            'slug' => $slug
        ]);
    }

    /**
     * @param Region $region
     * @param bool $sync
     */
    public function save(Region $region, bool $sync = true)
    {
        $this->regionRepository->save($region, $sync);
    }
}