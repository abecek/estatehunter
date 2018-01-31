<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 2017-10-17
 * Time: 03:39
 */

namespace Becek\EstatehunterBundle\Utils;

/**
 * Class OtodomOffer
 * @package Becek\EstatehunterBundle\Utils
 */
class OtodomOffer extends BaseOfferAbstract
{
    /**
     * @var string
     */
    protected $constructionMaterial;

    /**
     * @var array
     */
    protected $mustHave;

    /**
     * @var array
     */
    protected $additionalInfo;


    /**
     * @return string
     */
    public function getConstructionMaterial()
    {
        return $this->constructionMaterial;
    }

    /**
     * @param string $constructionMaterial
     */
    public function setConstructionMaterial($constructionMaterial)
    {
        $this->constructionMaterial = $constructionMaterial;
    }

    /**
     * @return array
     */
    public function getMustHave()
    {
        return $this->mustHave;
    }

    /**
     * @param array $mustHave
     */
    public function setMustHave($mustHave)
    {
        $this->mustHave = $mustHave;
    }

    /**
     * @return array
     */
    public function getAdditionalInfo()
    {
        return $this->additionalInfo;
    }

    /**
     * @param array $additionalInfo
     */
    public function setAdditionalInfo($additionalInfo)
    {
        $this->additionalInfo = $additionalInfo;
    }

}