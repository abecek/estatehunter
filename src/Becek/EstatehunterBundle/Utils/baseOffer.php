<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 2017-10-17
 * Time: 03:19
 */

namespace Becek\EstatehunterBundle\Utils;

/**
 * Class baseOffer
 * @package Becek\EstatehunterBundle\Utils
 * @abstract
 */
abstract class BaseOffer
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
     * @var string
     */
    protected $marketSource;

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
     * @var Datetime
     */
    protected $dateAdded;

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
     * @return string
     */
    public function getMarketSource()
    {
        return $this->marketSource;
    }

    /**
     * @param string $marketSource
     */
    public function setMarketSource($marketSource)
    {
        $this->marketSource = $marketSource;
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

}