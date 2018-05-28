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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=150)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=350, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="areaFrom", type="decimal", scale=2, nullable=true)
     */
    private $areaFrom;

    /**
     * @var string
     *
     * @ORM\Column(name="areaTo", type="decimal", scale=2, nullable=true)
     */
    private $areaTo;

    /**
     * @var string
     *
     * @ORM\Column(name="priceFrom", type="decimal", scale=2, nullable=true)
     */
    private $priceFrom;

    /**
     * @var string
     *
     * @ORM\Column(name="priceTo", type="decimal", scale=2, nullable=true)
     */
    private $priceTo;

    /**
     * @var string
     *
     * @ORM\Column(name="priceAreaFrom", type="decimal", scale=2, nullable=true)
     */
    private $priceAreaFrom;

    /**
     * @var string
     *
     * @ORM\Column(name="priceAreaTo", type="decimal", scale=2, nullable=true)
     */
    private $priceAreaTo;

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
     * @var int
     *
     * @ORM\Column(name="roomsCount", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $roomsCount;

    /**
     * @var string
     *
     * @ORM\Column(name="buildingType", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $buildingType;

    /**
     * @var int
     *
     * @ORM\Column(name="addedBy", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $addedBy;

    /**
     * @var int
     *
     * @ORM\Column(name="marketType", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $marketType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateUpdated", type="datetime", nullable=true)
     */
    private $dateUpdated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateLastSearch", type="datetime", nullable=true)
     */
    private $dateLastSearch;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=100, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=100, nullable=true)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="subregion", type="string", length=100, nullable=true)
     */
    private $subregion;

    /**
     * @var string
     *
     * @ORM\Column(name="district", type="string", length=100, nullable=true)
     */
    private $district;

    /**
     * @var string
     *
     * @ORM\Column(name="searchFrequency", type="decimal", precision=2, scale=2, options={"unsigned"=true})
     */
    private $searchFrequency = "1.5";

    /**
     * @var int
     *
     * @ORM\Column(name="state", type="smallint", options={"unsigned"=true})
     */
    private $state = 1;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser", type="integer", options={"unsigned"=true})
     */
    private $idUser;

    /**
     * Set areaFrom
     *
     * @param string $areaFrom
     *
     * @return Filter
     */
    public function setAreaFrom($areaFrom)
    {
        $this->areaFrom = $areaFrom;

        return $this;
    }

    /**
     * Get areaFrom
     *
     * @return string
     */
    public function getAreaFrom()
    {
        return $this->areaFrom;
    }

    /**
     * Set areaTo
     *
     * @param string $areaTo
     *
     * @return Filter
     */
    public function setAreaTo($areaTo)
    {
        $this->areaTo = $areaTo;

        return $this;
    }

    /**
     * Get areaTo
     *
     * @return string
     */
    public function getAreaTo()
    {
        return $this->areaTo;
    }

    /**
     * Set priceFrom
     *
     * @param string $priceFrom
     *
     * @return Filter
     */
    public function setPriceFrom($priceFrom)
    {
        $this->priceFrom = $priceFrom;

        return $this;
    }

    /**
     * Get priceFrom
     *
     * @return string
     */
    public function getPriceFrom()
    {
        return $this->priceFrom;
    }

    /**
     * Set priceTo
     *
     * @param string $priceTo
     *
     * @return Filter
     */
    public function setPriceTo($priceTo)
    {
        $this->priceTo = $priceTo;

        return $this;
    }

    /**
     * Get priceTo
     *
     * @return string
     */
    public function getPriceTo()
    {
        return $this->priceTo;
    }

    /**
     * Set priceAreaFrom
     *
     * @param string $priceAreaFrom
     *
     * @return Filter
     */
    public function setPriceAreaFrom($priceAreaFrom)
    {
        $this->priceAreaFrom = $priceAreaFrom;

        return $this;
    }

    /**
     * Get priceAreaFrom
     *
     * @return string
     */
    public function getPriceAreaFrom()
    {
        return $this->priceAreaFrom;
    }

    /**
     * Set priceAreaTo
     *
     * @param string $priceAreaTo
     *
     * @return Filter
     */
    public function setPriceAreaTo($priceAreaTo)
    {
        $this->priceAreaTo = $priceAreaTo;

        return $this;
    }

    /**
     * Get priceAreaTo
     *
     * @return string
     */
    public function getPriceAreaTo()
    {
        return $this->priceAreaTo;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Filter
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     *
     * @return Filter
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * Set dateLastSearch
     *
     * @param \DateTime $dateLastSearch
     *
     * @return Filter
     */
    public function setDateLastSearch($dateLastSearch)
    {
        $this->dateLastSearch = $dateLastSearch;

        return $this;
    }

    /**
     * Get dateLastSearch
     *
     * @return \DateTime
     */
    public function getDateLastSearch()
    {
        return $this->dateLastSearch;
    }

    /**
     * Set addedBy
     *
     * @param int $addedBy
     *
     * @return Filter
     */
    public function setAddedBy($addedBy)
    {
        $this->addedBy = $addedBy;

        return $this;
    }

    /**
     * Get addedBy
     *
     * @return int
     */
    public function getAddedBy()
    {
        return $this->addedBy;
    }

    /**
     * @return int
     */
    public function getMarketType()
    {
        return $this->marketType;
    }

    /**
     * @param int $marketType
     */
    public function setMarketType($marketType)
    {
        $this->marketType = $marketType;

        return $this;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return Filter
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set subregion
     *
     * @param string $subregion
     *
     * @return Filter
     */
    public function setSubregion($subregion)
    {
        $this->subregion = $subregion;

        return $this;
    }

    /**
     * Get subregion
     *
     * @return string
     */
    public function getSubregion()
    {
        return $this->subregion;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Filter
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set district
     *
     * @param string $district
     *
     * @return Filter
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $titile
     * @return Filter
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Filter
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getSearchFrequency()
    {
        return $this->searchFrequency;
    }

    /**
     * @param string $searchFrequency
     * @return Filter
     */
    public function setSearchFrequency($searchFrequency)
    {
        $this->searchFrequency = $searchFrequency;
        return $this;
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param int $state
     * @return Filter
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idUser
     *
     * @param int $idUser
     *
     * @return Filter
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
        return $this;
    }

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
     * @param int $roomsCount
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
     * @return int
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
     * @return int
     */
    public function getBuildingType()
    {
        return $this->buildingType;
    }

    /**
     * @param int $buildingType
     */
    public function setBuildingType($buildingType)
    {
        $this->buildingType = $buildingType;

        return $this;
    }

}

