<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 2017-10-17
 * Time: 03:19
 */

namespace Becek\EstatehunterBundle\Utils;

/**
 * Class BaseOfferAbstract
 * @package Becek\EstatehunterBundle\Utils
 */
abstract class BaseOfferAbstract
{
    /**
     * @var integer
     */
    protected $idOffer;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var  string
     */
    protected $description;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var float
     */
    protected $priceByArea;

    /**
     * @var float
     */
    protected $area;

    /**
     * @var float
     */
    protected $groundArea;

    /**
     * @var integer
     */
    protected $constructionYear;

    /**
     * @var integer
     */
    protected $roomCount;

    /**
     * @var integer
     */
    protected $floor;

    /**
     * @var integer
     */
    protected $floorCount;

    /**
     * @var array|mixed
     */
    protected $localization;

    /**
     * @var array|mixed
     */
    protected $addedBy;

    /**
     * @var string
     */
    protected $offerType;

    /**
     * @var string
     */
    protected $buildingType;

    /**
     * @var string
     */
    protected $category;

    /**
     * @var Datetime
     */
    protected $dateAdded;

    /**
     * @var string
     */
    protected $shortDescription;

    /**
     * @return int
     */
    public function getIdOffer()
    {
        return $this->idOffer;
    }

    /**
     * @param int $idOffer
     */
    public function setIdOffer($idOffer)
    {
        $this->idOffer = $idOffer;
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
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getPriceByArea()
    {
        return $this->priceByArea;
    }

    /**
     * @param float $priceByArea
     */
    public function setPriceByArea($priceByArea)
    {
        $this->priceByArea = $priceByArea;
    }

    /**
     * @return float
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param float $area
     */
    public function setArea($area)
    {
        $this->area = $area;
    }

    /**
     * @return float
     */
    public function getGroundArea()
    {
        return $this->groundArea;
    }

    /**
     * @param float $groundArea
     */
    public function setGroundArea($groundArea)
    {
        $this->groundArea = $groundArea;
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
     */
    public function setConstructionYear($constructionYear)
    {
        $this->constructionYear = $constructionYear;
    }

    /**
     * @return int
     */
    public function getRoomCount()
    {
        return $this->roomCount;
    }

    /**
     * @param int $roomCount
     */
    public function setRoomCount($roomCount)
    {
        $this->roomCount = $roomCount;
    }

    /**
     * @return int
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * @param int $floor
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;
    }

    /**
     * @return int
     */
    public function getFloorCount()
    {
        return $this->floorCount;
    }

    /**
     * @param int $floorCount
     */
    public function setFloorCount($floorCount)
    {
        $this->floorCount = $floorCount;
    }

    /**
     * @return array|mixed
     */
    public function getLocalization()
    {
        return $this->localization;
    }

    /**
     * @param array|mixed $localization
     */
    public function setLocalization($localization)
    {
        $this->localization = $localization;
    }

    /**
     * @return array|mixed
     */
    public function getAddedBy()
    {
        return $this->addedBy;
    }

    /**
     * @param array|mixed $addedBy
     */
    public function setAddedBy($addedBy)
    {
        $this->addedBy = $addedBy;
    }

    /**
     * @return mixed
     */
    public function getOfferType()
    {
        return $this->offerType;
    }

    /**
     * @param mixed $offerType
     */
    public function setOfferType($offerType)
    {
        $this->offerType = $offerType;
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
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return Datetime
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * @param Datetime $dateAdded
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;
    }

    /**
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * @param string $shortDescripton
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
    }

}