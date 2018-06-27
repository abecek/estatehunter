<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 26.06.2018
 * Time: 22:19
 */

namespace Becek\EstatehunterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flat
 *
 * @ORM\Table(name="flat")
 * @ORM\Entity(repositoryClass="Becek\EstatehunterBundle\Repository\Filters\Flat")
 */
class Flat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

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
     * @ORM\Column(name="area", type="decimal", scale=2, nullable=true)
     */
    private $area;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", scale=2, nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="priceArea", type="decimal", scale=2, nullable=true)
     */
    private $priceArea;

    /**
     * @var int
     *
     * @ORM\Column(name="constructionYear", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $constructionYear;

    /**
     * @var int
     *
     * @ORM\Column(name="floorsCount", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $floorsCount;

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
     * @ORM\ManyToMany(targetEntity="Search", mappedBy="flats")
     */
    private $searches;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Flat
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @return Flat
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
     * @return Flat
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param string $area
     * @return Flat
     */
    public function setArea($area)
    {
        $this->area = $area;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     * @return Flat
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getPriceArea()
    {
        return $this->priceArea;
    }

    /**
     * @param string $priceArea
     * @return Flat
     */
    public function setPriceArea($priceArea)
    {
        $this->priceArea = $priceArea;
        return $this;
    }

    /**
     * @return int
     */
    public function getConstructionYear()
    {
        return $this->constructionYear;
    }

    /**
     * @param int $constructionYear
     * @return Flat
     */
    public function setConstructionYear($constructionYear)
    {
        $this->constructionYear = $constructionYear;
        return $this;
    }

    /**
     * @return int
     */
    public function getFloorsCount()
    {
        return $this->floorsCount;
    }

    /**
     * @param int $floorsCount
     * @return Flat
     */
    public function setFloorsCount($floorsCount)
    {
        $this->floorsCount = $floorsCount;
        return $this;
    }

    /**
     * @return int
     */
    public function getRoomsCount()
    {
        return $this->roomsCount;
    }

    /**
     * @param int $roomsCount
     * @return Flat
     */
    public function setRoomsCount($roomsCount)
    {
        $this->roomsCount = $roomsCount;
        return $this;
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
     * @return Flat
     */
    public function setBuildingType($buildingType)
    {
        $this->buildingType = $buildingType;
        return $this;
    }

    /**
     * @return int
     */
    public function getAddedBy()
    {
        return $this->addedBy;
    }

    /**
     * @param int $addedBy
     * @return Flat
     */
    public function setAddedBy($addedBy)
    {
        $this->addedBy = $addedBy;
        return $this;
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
     * @return Flat
     */
    public function setMarketType($marketType)
    {
        $this->marketType = $marketType;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTime $dateCreated
     * @return Flat
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * @param \DateTime $dateUpdated
     * @return Flat
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Flat
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     * @return Flat
     */
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubregion()
    {
        return $this->subregion;
    }

    /**
     * @param string $subregion
     * @return Flat
     */
    public function setSubregion($subregion)
    {
        $this->subregion = $subregion;
        return $this;
    }

    /**
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @param string $district
     * @return Flat
     */
    public function setDistrict($district)
    {
        $this->district = $district;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdSearchResult()
    {
        return $this->idSearchResult;
    }

    /**
     * @param int $idSearchResult
     * @return Flat
     */
    public function setIdSearchResult($idSearchResult)
    {
        $this->idSearchResult = $idSearchResult;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSearches()
    {
        return $this->searches;
    }

    /**
     * @param mixed $searches
     * @return Flat
     */
    public function setSearches($searches)
    {
        $this->searches = $searches;
        return $this;
    }


}