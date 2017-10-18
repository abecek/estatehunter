<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 2017-10-18
 * Time: 00:51
 */

namespace Becek\EstatehunterBundle\Utils;

/**
 * Class OfferGenerator
 * @package Becek\EstatehunterBundle\Utils
 * @abstract
 */
abstract class OfferGenerator
{
    /**
     * @var array
     */
    protected $offersAsIdsArray = array();

    /**
     * @var array
     */
    protected $offersAsStringsArray = array();

    /**
     * @var array
     */
    protected $offersAsHtmlArray = array();

    /**
     * @var array
     */
    protected $offersAsObjectsArray = array();

    /**
     * @var
     */
    protected $dom;

    /**
     * @var
     */
    protected $domx;

    /**
     * @var string
     */
    protected $buildingType;

    /**
     * @var string
     */
    protected $offerType;

    /**
     * @var float
     */
    protected $priceFrom;

    /**
     * @var float
     */
    protected $priceTo;

    /**
     * @var float
     */
    protected $priceByAreaFrom;

    /**
     * @var float
     */
    protected $priceByAreaTo;

    /**
     * @var float
     */
    protected $areaFrom;

    /**
     * @var float
     */
    protected $areaTo;

    /**
     * @var array|mixed
     */
    protected $localization;

    /**
     * @var string
     */
    protected $addedBy;


    /**
     * @return array
     */
    public function getOffersAsIdsArray()
    {
        return $this->offersAsIdsArray;
    }

    /**
     * @param array $offersAsIdsArray
     */
    public function setOffersAsIdsArray($offersAsIdsArray)
    {
        $this->offersAsIdsArray = $offersAsIdsArray;
    }

    /**
     * @return array
     */
    public function getOffersAsStringsArray()
    {
        return $this->offersAsStringsArray;
    }

    /**
     * @param array $offersAsStringsArray
     */
    public function setOffersAsStringsArray($offersAsStringsArray)
    {
        $this->offersAsStringsArray = $offersAsStringsArray;
    }

    /**
     * @return array
     */
    public function getOffersAsHtmlArray()
    {
        return $this->offersAsHtmlArray;
    }

    /**
     * @param array $offersAsHtmlArray
     */
    public function setOffersAsHtmlArray($offersAsHtmlArray)
    {
        $this->offersAsHtmlArray = $offersAsHtmlArray;
    }

    /**
     * @return array
     */
    public function getOffersAsObjectsArray()
    {
        return $this->offersAsObjectsArray;
    }

    /**
     * @param array $offersAsObjectsArray
     */
    public function setOffersAsObjectsArray($offersAsObjectsArray)
    {
        $this->offersAsObjectsArray = $offersAsObjectsArray;
    }

    /**
     * @return mixed
     */
    public function getDom()
    {
        return $this->dom;
    }

    /**
     * @param mixed $dom
     */
    public function setDom($dom)
    {
        $this->dom = $dom;
    }

    /**
     * @return mixed
     */
    public function getDomx()
    {
        return $this->domx;
    }

    /**
     * @param mixed $domx
     */
    public function setDomx($domx)
    {
        $this->domx = $domx;
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
    public function getOfferType()
    {
        return $this->offerType;
    }

    /**
     * @param string $offerType
     */
    public function setOfferType($offerType)
    {
        $this->offerType = $offerType;
    }


    /**
     * @return float
     */
    public function getPriceFrom()
    {
        return $this->priceFrom;
    }

    /**
     * @param float $priceFrom
     */
    public function setPriceFrom($priceFrom)
    {
        $this->priceFrom = $priceFrom;
    }

    /**
     * @return float
     */
    public function getPriceTo()
    {
        return $this->priceTo;
    }

    /**
     * @param float $priceTo
     */
    public function setPriceTo($priceTo)
    {
        $this->priceTo = $priceTo;
    }

    /**
     * @return float
     */
    public function getPriceByAreaFrom()
    {
        return $this->priceByAreaFrom;
    }

    /**
     * @param float $priceByAreaFrom
     */
    public function setPriceByAreaFrom($priceByAreaFrom)
    {
        $this->priceByAreaFrom = $priceByAreaFrom;
    }

    /**
     * @return float
     */
    public function getPriceByAreaTo()
    {
        return $this->priceByAreaTo;
    }

    /**
     * @param float $priceByAreaTo
     */
    public function setPriceByAreaTo($priceByAreaTo)
    {
        $this->priceByAreaTo = $priceByAreaTo;
    }

    /**
     * @return float
     */
    public function getAreaFrom()
    {
        return $this->areaFrom;
    }

    /**
     * @param float $areaFrom
     */
    public function setAreaFrom($areaFrom)
    {
        $this->areaFrom = $areaFrom;
    }

    /**
     * @return float
     */
    public function getAreaTo()
    {
        return $this->areaTo;
    }

    /**
     * @param float $areaTo
     */
    public function setAreaTo($areaTo)
    {
        $this->areaTo = $areaTo;
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
     * @return string
     */
    public function getAddedBy()
    {
        return $this->addedBy;
    }

    /**
     * @param string $addedBy
     */
    public function setAddedBy($addedBy)
    {
        $this->addedBy = $addedBy;
    }



    public function loadOffersFromPage($options){}

}