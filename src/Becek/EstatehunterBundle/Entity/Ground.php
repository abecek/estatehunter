<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 26.06.2018
 * Time: 22:20
 */

namespace Becek\EstatehunterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ground
 *
 * @ORM\Table(name="ground")
 * @ORM\Entity(repositoryClass="Becek\EstatehunterBundle\Repository\Ground")
 */
class Ground
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
     * @var float
     *
     * @ORM\Column(name="groundArea", type="float", nullable=true)
     */
    private $groundArea;

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
     * @ORM\ManyToMany(targetEntity="Search", mappedBy="grounds")
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
     * @return Ground
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
     * @return Ground
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
     * @return Ground
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
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
     * @return Ground
     */
    public function setGroundArea($groundArea)
    {
        $this->groundArea = $groundArea;
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
     * @return Ground
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
     * @return Ground
     */
    public function setPriceArea($priceArea)
    {
        $this->priceArea = $priceArea;
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
     * @return Ground
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
     * @return Ground
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
     * @return Ground
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
     * @return Ground
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
     * @return Ground
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
     * @return Ground
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
     * @return Ground
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
     * @return Ground
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
     * @return Ground
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
     * @return Ground
     */
    public function setSearches($searches)
    {
        $this->searches = $searches;
        return $this;
    }



}