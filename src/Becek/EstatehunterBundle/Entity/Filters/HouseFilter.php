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
     * @ORM\Column(name="roomsCountFrom", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $roomsCountFrom;

    /**
     * @var string
     *
     * @ORM\Column(name="roomsCountTo", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $roomsCountTo;

    /**
     * @var int
     *
     * @ORM\Column(name="floorsCount", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $floorsCount;

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
    private $searchFrequency = "1";

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
     *
     * @ORM\OneToMany(targetEntity="Becek\EstatehunterBundle\Entity\Search", mappedBy="houseFilter")
     */
    private $searches;

    /**
     * @return mixed
     */
    public function getSearches()
    {
        return $this->searches;
    }

    /**
     * @param mixed $searches
     */
    public function setSearches($searches)
    {
        $this->searches = $searches;
    }



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
     * @param string $title
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
     * Set roomsCountFrom
     *
     * @param int $roomsCountFrom
     *
     * @return HouseFilter
     */
    public function setRoomsCountFrom($roomsCountFrom)
    {
        $this->roomsCountFrom = $roomsCountFrom;

        return $this;
    }

    /**
     * Get roomsCountFrom
     *
     * @return int
     */
    public function getRoomsCountFrom()
    {
        return $this->roomsCountFrom;
    }

    /**
     * Get roomsCountTo
     *
     * @return int
     */
    public function getRoomsCountTo()
    {
        return $this->roomsCountTo;
    }

    /**
     * Set roomsCountTo
     *
     * @param int $roomsCountTo
     *
     * @return HouseFilter
     */
    public function setRoomsCountTo($roomsCountTo)
    {
        $this->roomsCountTo = $roomsCountTo;

        return $this;
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
     * @param int $buildingType
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
     * @return int
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

