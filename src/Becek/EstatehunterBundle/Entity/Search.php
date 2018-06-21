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
     * @ORM\Column(name="idSearch", type="integer", options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idSearch;


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
     * Get idSearch
     *
     * @return int
     */
    public function getIdSearch()
    {
        return $this->idSearch;
    }

    /**
     * Set idFilter
     *
     * @param integer $idFilter
     *
     * @return Search
     */
    public function setIdFilter($idFilter)
    {
        $this->idFilter = $idFilter;

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
}

