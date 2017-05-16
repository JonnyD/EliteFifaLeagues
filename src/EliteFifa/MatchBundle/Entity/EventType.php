<?php

namespace EliteFifa\MatchBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

class EventType
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var ArrayCollection|Event[]
     */
    private $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Has event
     *
     * @param Event $event
     * @return boolean
     */
    public function hasEvent(Event $event)
    {
        return $this->events->contains($event);
    }

    /**
     * Add event
     *
     * @param Event $event
     */
    public function addEvent(Event $event)
    {
        if (!$this->hasEvent($event)) {
            $this->events->add($event);
            $event->setEventType($this);
        }
    }

    /**
     * Remove event
     *
     * @param Event $event
     */
    public function removeEvent(Event $event)
    {
        if ($this->hasEvent($event)) {
            $this->events->removeElement($event);
            $event->removeEventType();
        }
    }

    /**
     * Get events
     *
     * @return ArrayCollection
     */
    public function getEvents()
    {
        return $this->events;
    }

}