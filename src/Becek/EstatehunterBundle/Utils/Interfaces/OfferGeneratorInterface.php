<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 2017-10-19
 * Time: 19:50
 */

namespace Becek\EstatehunterBundle\Utils\Interfaces;

interface OfferGeneratorInterface
{
    /**
     * @param array $options
     * @param int $currentPage
     * @return mixed
     */
    public function prepareStringUrlWithOptions($options, $currentPage = 1);

    /**
     * @param string $url
     * @return string
     */
    public function getHtmlFromUrl($url);

    /**
     * @param \DOMDocument $Dom
     * @return OlxOffer|DomGratkaOffer|OtodomOffer
     */
    public function createOfferFromSummary($Dom);

}