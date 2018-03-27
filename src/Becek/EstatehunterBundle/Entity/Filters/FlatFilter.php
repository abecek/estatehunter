<?php

namespace Becek\EstatehunterBundle\Entity\Filters;

use Doctrine\ORM\Mapping as ORM;

/**
 * FlatFilter
 *
 * @ORM\Table(name="filters_flat_filter")
 * @ORM\Entity(repositoryClass="Becek\EstatehunterBundle\Repository\Filters\FlatFilterRepository")
 */
class FlatFilter
{
    /**
     * @var int
     *
     * @ORM\Column(name="idFlatFilter", type="integer", options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idFlatFilter;

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
     * @ORM\Column(name="floor", type="string", length=25, nullable=true)
     */
    private $floor;

    /**
     * @var int
     *
     * @ORM\Column(name="floorsCountFrom", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $floorsCountFrom;

    /**
     * @var int
     *
     * @ORM\Column(name="floorsCountTo", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $floorsCountTo;

    /**
     * @var string
     *
     * @ORM\Column(name="roomsCount", type="string", length=20, nullable=true, options={"unsigned"=true})
     */
    private $roomsCount;

    /**
     * @var bool
     *
     * @ORM\Column(name="isFurnished", type="boolean", nullable=true)
     */
    private $isFurnished;

    /**
     * @var string
     *
     * @ORM\Column(name="additionalArea", type="string", length=30, nullable=true)
     */
    private $additionalArea;

    /**
     * @var string
     *
     * @ORM\Column(name="buildingType", type="string", length=20, nullable=true)
     */
    private $buildingType;

    /**
     * Get idFlatFilter
     *
     * @return int
     */
    public function getIdFlatFilter()
    {
        return $this->idFlatFilter;
    }

    /**
     * Set constructionYearFrom
     *
     * @param integer $constructionYearFrom
     *
     * @return FlatFilter
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
     * @return FlatFilter
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
     * Set floor
     *
     * @param string $floor
     *
     * @return FlatFilter
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * Get floor
     *
     * @return string
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * Set floorsCountFrom
     *
     * @param integer $floorsCountFrom
     *
     * @return FlatFilter
     */
    public function setFloorsCountFrom($floorsCountFrom)
    {
        $this->floorsCountFrom = $floorsCountFrom;

        return $this;
    }

    /**
     * Get floorsCountFrom
     *
     * @return int
     */
    public function getFloorsCountFrom()
    {
        return $this->floorsCountFrom;
    }

    /**
     * Set floorsCountTo
     *
     * @param integer $floorsCountTo
     *
     * @return FlatFilter
     */
    public function setFloorsCountTo($floorsCountTo)
    {
        $this->floorsCountTo = $floorsCountTo;

        return $this;
    }

    /**
     * Get floorsCountTo
     *
     * @return int
     */
    public function getFloorsCountTo()
    {
        return $this->floorsCountTo;
    }

    /**
     * Set roomsCount
     *
     * @param string $roomsCount
     *
     * @return FlatFilter
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
     * Set isFurnished
     *
     * @param boolean $isFurnished
     *
     * @return FlatFilter
     */
    public function setIsFurnished($isFurnished)
    {
        $this->isFurnished = $isFurnished;

        return $this;
    }

    /**
     * Get isFurnished
     *
     * @return bool
     */
    public function getIsFurnished()
    {
        return $this->isFurnished;
    }

    /**
     * Set additionalArea
     *
     * @param string $additionalArea
     *
     * @return FlatFilter
     */
    public function setAdditionalArea($additionalArea)
    {
        $this->additionalArea = $additionalArea;

        return $this;
    }

    /**
     * Get additionalArea
     *
     * @return string
     */
    public function getAdditionalArea()
    {
        return $this->additionalArea;
    }

    /**
     * @return string
     */
    public function getBuildingType()
    {
        return $this->buildingType;
    }

    /**
     * @param string $buildingType
     */
    public function setBuildingType($buildingType)
    {
        $this->buildingType = $buildingType;

        return $this;
    }

}

