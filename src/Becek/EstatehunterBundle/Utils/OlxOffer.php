<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 2018-01-31
 * Time: 22:02
 */

namespace Becek\EstatehunterBundle\Utils;

/**
 * Class OlxOffer
 * @package Becek\EstatehunterBundle\Utils
 */
class OlxOffer extends BaseOfferAbstract
{
    /**
     * @var boolean
     */
    protected $isFurnished;

    /**
     * @return boolean
     */
    public function isIsFurnished()
    {
        return $this->isFurnished;
    }

    /**
     * @param boolean $isFurnished
     */
    public function setIsFurnished($isFurnished)
    {
        $this->isFurnished = $isFurnished;
    }


}