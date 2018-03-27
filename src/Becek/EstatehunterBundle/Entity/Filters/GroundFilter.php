<?php

namespace Becek\EstatehunterBundle\Entity\Filters;

use Doctrine\ORM\Mapping as ORM;

/**
 * GroundFilter
 *
 * @ORM\Table(name="filters_ground_filter")
 * @ORM\Entity(repositoryClass="Becek\EstatehunterBundle\Repository\Filters\GroundFilterRepository")
 */
class GroundFilter
{
    /**
     * @var int
     *
     * @ORM\Column(name="idGroundFilter", type="integer", options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idGroundFilter;

    /**
     * @var float
     *
     * @ORM\Column(name="groundAreaFrom", type="float", nullable=true)
     */
    private $groundAreaFrom;

    /**
     * @var float
     *
     * @ORM\Column(name="groundAreaTo", type="float", nullable=true)
     */
    private $groundAreaTo;


    /**
     * Get idGroundFilter
     *
     * @return int
     */
    public function getIdGroundFilter()
    {
        return $this->idGroundFilter;
    }

    /**
     * Set groundAreaFrom
     *
     * @param float $groundAreaFrom
     *
     * @return GroundFilter
     */
    public function setGroundAreaFrom($groundAreaFrom)
    {
        $this->groundAreaFrom = $groundAreaFrom;

        return $this;
    }

    /**
     * Get groundAreaFrom
     *
     * @return float
     */
    public function getGroundAreaFrom()
    {
        return $this->groundAreaFrom;
    }

    /**
     * Set groundAreaTo
     *
     * @param float $groundAreaTo
     *
     * @return GroundFilter
     */
    public function setGroundAreaTo($groundAreaTo)
    {
        $this->groundAreaTo = $groundAreaTo;

        return $this;
    }

    /**
     * Get groundAreaTo
     *
     * @return float
     */
    public function getGroundAreaTo()
    {
        return $this->groundAreaTo;
    }
}

