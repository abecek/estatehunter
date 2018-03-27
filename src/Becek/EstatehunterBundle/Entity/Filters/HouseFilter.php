<?php

namespace Becek\EstatehunterBundle\Entity\Filters;

use Doctrine\ORM\Mapping as ORM;

/**
 * HouseFilter
 *
 * @ORM\Table(name="filters_house_filter")
 * @ORM\Entity(repositoryClass="Becek\EstatehunterBundle\Repository\Filters\HouseFilterRepository")
 */
class HouseFilter
{
    /**
     * @var int
     *
     * @ORM\Column(name="idHouseFilter", type="integer", options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idHouseFilter;

    /**
     * @var int
     *
     * @ORM\Column(name="constructionYearFrom", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $constructionYearFrom;

    /**
     * @var int
     *
     * @ORM\Column(name="constructionYearTo", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $constructionYearTo;

    /**
     * @var string
     *
     * @ORM\Column(name="roomsCount", type="string", length=20, nullable=true)
     */
    private $roomsCount;

    /**
     * @var int
     *
     * @ORM\Column(name="floorsCount", type="smallint", nullable=true)
     */
    private $floorsCount;

    /**
     * @var string
     *
     * @ORM\Column(name="buildingType", type="string", length=20, nullable=true)
     */
    private $buildingType;

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
     * Get idHouseFilter
     *
     * @return int
     */
    public function getIdHouseFilter()
    {
        return $this->idHouseFilter;
    }

    /**
     * Set constructionYearFrom
     *
     * @param integer $constructionYearFrom
     *
     * @return HouseFilter
     */
    public function setConstructionYearFrom($constructionYearFrom)
    {
        $this->constructionYearFrom = $constructionYearFrom;

        return $this;
    }

    /**
     * Get constructionYearFrom
     *
     * @return int
     */
    public function getConstructionYearFrom()
    {
        return $this->constructionYearFrom;
    }

    /**
     * Set constructionYearTo
     *
     * @param integer $constructionYearTo
     *
     * @return HouseFilter
     */
    public function setConstructionYearTo($constructionYearTo)
    {
        $this->constructionYearTo = $constructionYearTo;

        return $this;
    }

    /**
     * Get constructionYearTo
     *
     * @return int
     */
    public function getConstructionYearTo()
    {
        return $this->constructionYearTo;
    }

    /**
     * Set roomsCount
     *
     * @param string $roomsCount
     *
     * @return HouseFilter
     */
    public function setRoomsCount($roomsCount)
    {
        $this->roomsCount = $roomsCount;

        return $this;
    }

    /**
     * Get roomsCount
     *
     * @return string
     */
    public function getRoomsCount()
    {
        return $this->roomsCount;
    }

    /**
     * Set floorsCount
     *
     * @param integer $floorsCount
     *
     * @return HouseFilter
     */
    public function setFloorsCount($floorsCount)
    {
        $this->floorsCount = $floorsCount;

        return $this;
    }

    /**
     * Get floorsCount
     *
     * @return int
     */
    public function getFloorsCount()
    {
        return $this->floorsCount;
    }

    /**
     * Set buildingType
     *
     * @param string $buildingType
     *
     * @return HouseFilter
     */
    public function setBuildingType($buildingType)
    {
        $this->buildingType = $buildingType;

        return $this;
    }

    /**
     * Get buildingType
     *
     * @return string
     */
    public function getBuildingType()
    {
        return $this->buildingType;
    }

    /**
     * Set groundAreaFrom
     *
     * @param float $groundAreaFrom
     *
     * @return HouseFilter
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
     * @return HouseFilter
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

