<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 2017-10-17
 * Time: 03:35
 */

namespace Becek\EstatehunterBundle\Utils;

/**
 * Class DomGratkaOffer
 * @package Becek\EstatehunterBundle\Utils
 */
class DomGratkaOffer extends BaseOffer
{
    /**
     * @var string
     */
    private $surcharge;

    /**
     * @var string|mixed
     */
    private $additionalArea;

    /**
     * @var string
     */
    private $shortDescription;


    /**
     * GratkaOffer constructor.
     * @param mixed|string $additionalArea
     */
    public function __construct($additionalArea = null)
    {
        $this->additionalArea = $additionalArea;
    }

    /**
     * @return mixed
     */
    public function getSurcharge()
    {
        return $this->surcharge;
    }

    /**
     * @param mixed $surcharge
     */
    public function setSurcharge($surcharge)
    {
        $this->surcharge = $surcharge;
    }

    /**
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * @param string $shortDescription
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
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