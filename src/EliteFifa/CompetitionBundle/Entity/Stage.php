<?php

namespace EliteFifa\CompetitionBundle\Entity;

abstract class Stage
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $order;

    /**
     * @var MultiStage
     */
    private $parent;

    /**
     * @var Stage
     */
    private $nextStage;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     */
    public function setOrder(int $order)
    {
        $this->order = $order;
    }

    /**
     * @return MultiStage
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param $parent
     */
    public function setParent(MultiStage $parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return Stage
     */
    public function getNextStage()
    {
        return $this->nextStage;
    }

    /**
     * @param Stage $stage
     */
    public function setNextStage(Stage $stage)
    {
        $this->nextStage = $stage;
    }
}
