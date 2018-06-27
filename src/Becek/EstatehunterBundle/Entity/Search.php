<?php

namespace Becek\EstatehunterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Search
 *
 * @ORM\Table(name="search")
 * @ORM\Entity(repositoryClass="Becek\EstatehunterBundle\Repository\SearchRepository")
 */
class Search
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateSearch", type="datetime")
     */
    private $dateSearch;

    /**
     * @var string
     *
     * @ORM\Column(name="errors", type="text", nullable=true)
     */
    private $errors;

    /**
     * @var int
     *
     * @ORM\Column(name="resultsCount", type="integer", options={"unsigned"=true})
     */
    private $resultsCount;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="Becek\EstatehunterBundle\Entity\Filters\FlatFilter", inversedBy="searches")
     * @ORM\JoinColumn(name="idFlatFilter", referencedColumnName="idFlatFilter")
     */
    private $flatFilter;


    /**
     * @ORM\ManyToOne(targetEntity="Becek\EstatehunterBundle\Entity\Filters\HouseFilter", inversedBy="searches")
     * @ORM\JoinColumn(name="idHouseFilter", referencedColumnName="idHouseFilter")
     */
    private $houseFilter;

    /**
     * @ORM\ManyToOne(targetEntity="Becek\EstatehunterBundle\Entity\Filters\GroundFilter", inversedBy="searches")
     * @ORM\JoinColumn(name="idGroundFilter", referencedColumnName="idGroundFilter")
     */
    private $groundFilter;



    /**
     *
     * @ORM\ManyToMany(targetEntity="Flat", inversedBy="searches")
     * @ORM\JoinTable(name="flat_search_results")
     */
    private $flats;

    /**
     *
     * @ORM\ManyToMany(targetEntity="House", inversedBy="searches")
     * @ORM\JoinTable(name="house_search_results")
     */
    private $houses;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Ground", inversedBy="searches")
     * @ORM\JoinTable(name="ground_search_results")
     */
    private $grounds;



    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Search
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    /**
     * Get idFilter
     *
     * @return int
     */
    public function getIdFilter()
    {
        return $this->idFilter;
    }

    /**
     * Set dateSearch
     *
     * @param \DateTime $dateSearch
     *
     * @return Search
     */
    public function setDateSearch($dateSearch)
    {
        $this->dateSearch = $dateSearch;

        return $this;
    }

    /**
     * Get dateSearch
     *
     * @return \DateTime
     */
    public function getDateSearch()
    {
        return $this->dateSearch;
    }

    /**
     * Set errors
     *
     * @param string $errors
     *
     * @return Search
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * Get errors
     *
     * @return string
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set resultsCount
     *
     * @param integer $resultsCount
     *
     * @return Search
     */
    public function setResultsCount($resultsCount)
    {
        $this->resultsCount = $resultsCount;

        return $this;
    }

    /**
     * Get resultsCount
     *
     * @return int
     */
    public function getResultsCount()
    {
        return $this->resultsCount;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Search
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getFlatFilter()
    {
        return $this->flatFilter;
    }

    /**
     * @param mixed $flatFilter
     */
    public function setFlatFilter($flatFilter)
    {
        $this->flatFilter = $flatFilter;
    }

    /**
     * @return mixed
     */
    public function getHouseFilter()
    {
        return $this->houseFilter;
    }

    /**
     * @param mixed $houseFilter
     */
    public function setHouseFilter($houseFilter)
    {
        $this->houseFilter = $houseFilter;
    }

    /**
     * @return mixed
     */
    public function getGroundFilter()
    {
        return $this->groundFilter;
    }

    /**
     * @param mixed $groundFilter
     */
    public function setGroundFilter($groundFilter)
    {
        $this->groundFilter = $groundFilter;
    }

    /**
     * @return mixed
     */
    public function getFlats()
    {
        return $this->flats;
    }

    /**
     * @param mixed $flats
     */
    public function setFlats($flats)
    {
        $this->flats = $flats;
    }

    /**
     * @return mixed
     */
    public function getHouses()
    {
        return $this->houses;
    }

    /**
     * @param mixed $houses
     * @return Search
     */
    public function setHouses($houses)
    {
        $this->houses = $houses;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGrounds()
    {
        return $this->grounds;
    }

    /**
     * @param mixed $grounds
     * @return Search
     */
    public function setGrounds($grounds)
    {
        $this->grounds = $grounds;
        return $this;
    }


}

