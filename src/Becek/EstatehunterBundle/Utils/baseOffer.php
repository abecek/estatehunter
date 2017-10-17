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
 *
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
     * @var Datetime
     */
    protected $dateAdded;

}