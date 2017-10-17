<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 2017-10-17
 * Time: 03:35
 */

namespace Becek\EstatehunterBundle\Utils;

/**
 * Class GratkaOffer
 * @package Becek\EstatehunterBundle\Utils
 */
class GratkaOffer extends BaseOffer
{
    /**
     * @var string|mixed
     */
    private $additionalArea;

    /**
     * @return int
     */
    public function getIdOffer()
    {
        return $this->idOffer;
    }

    /**
     * @param int $idOffer
     * @return BaseOffer
     */
    public function setIdOffer($idOffer)
    {
        $this->idOffer = $idOffer;
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
     * @return BaseOffer
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
     * @return BaseOffer
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
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
     * @return BaseOffer
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
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
     * @return BaseOffer
     */
    public function setPriceByArea($priceByArea)
    {
        $this->priceByArea = $priceByArea;
        return $this;
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
     * @return BaseOffer
     */
    public function setArea($area)
    {
        $this->area = $area;
        return $this;
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
     * @return BaseOffer
     */
    public function setMarketSource($marketSource)
    {
        $this->marketSource = $marketSource;
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
     * @return BaseOffer
     */
    public function setConstructionYear($constructionYear)
    {
        $this->constructionYear = $constructionYear;
        return $this;
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
     * @return BaseOffer
     */
    public function setRoomCount($roomCount)
    {
        $this->roomCount = $roomCount;
        return $this;
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
     * @return BaseOffer
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;
        return $this;
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
     * @return BaseOffer
     */
    public function setFloorCount($floorCount)
    {
        $this->floorCount = $floorCount;
        return $this;
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
     * @return BaseOffer
     */
    public function setLocalization($localization)
    {
        $this->localization = $localization;
        return $this;
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
     * @return BaseOffer
     */
    public function setAddedBy($addedBy)
    {
        $this->addedBy = $addedBy;
        return $this;
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
     * @return BaseOffer
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;
        return $this;
    }

    /**
     * @return mixed|string
     */
    public function getAdditionalArea()
    {
        return $this->additionalArea;
    }

    /**
     * @param mixed|string $additionalArea
     */
    public function setAdditionalArea($additionalArea)
    {
        $this->additionalArea = $additionalArea;
    }

}