<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 2017-10-19
 * Time: 19:17
 */

namespace Becek\EstatehunterBundle\Utils\Generators;

use Symfony\Component\Filesystem\Filesystem;
use Becek\EstatehunterBundle\Utils\Generators\OfferGenerator;
use Becek\EstatehunterBundle\Utils\Interfaces\OfferGeneratorInterface;
use Becek\EstatehunterBundle\Utils\OtodomOffer;

class OtodomGenerator extends OfferGenerator implements OfferGeneratorInterface
{

    /**
     * @param array $options
     * @param int $currentPage
     * @return mixed
     */
    public function prepareStringUrlWithOptions($options, $currentPage = 1)
    {
        if(is_array($options) && !empty($options)){
            isset($options['buildingType']) ? $this->buildingType = $options['buildingType'] : null;
            isset($options['offerType']) ? $this->offerType = $options['offerType'] : null;

            isset($options['priceFrom']) ? $this->priceFrom = $options['priceFrom'] : null;
            isset($options['priceTo']) ? $this->priceTo = $options['priceTo'] : null;
            isset($options['priceByAreaFrom']) ? $this->priceByAreaFrom = $options['priceByAreaFrom'] : null;
            isset($options['priceByAreaTo']) ? $this->priceByAreaTo = $options['priceByAreaTo'] : null;
            isset($options['areaFrom']) ? $this->areaFrom = $options['areaFrom'] : null;
            isset($options['areaTo']) ? $this->areaTo = $options['areaTo'] : null;
            isset($options['localization']) ? $this->localization = $options['localization'] : null;
            isset($options['addedBy']) ? $this->addedBy = $options['addedBy'] : $this->addedBy = null;
        }

        $region = isset($options['localization']['region']) ? $options['localization']['region'] : '';

        $town = isset($options['localization']['town']) ? $options['localization']['town'] : '';

        $isSubRegion = false;
        if(isset($options['localization']['subregion']) && $options['localization']['subregion'] !== null) {
            $subregion =  $options['localization']['subregion'];
            $isSubRegion = true;
        }
        else {
            $subregion = '';
        }

        $url = 'https://www.otodom.pl/sprzedaz/mieszkanie/';
        $url .= $town .'/';

        if($this->priceFrom !== null) $url .= 'search[filter_float_price:from]='. $this->priceFrom .'&';
        if($this->priceTo !== null) $url .= 'search[filter_float_price:to]='. $this->priceTo .'&';
        if($this->priceByAreaFrom !== null) $url .= 'search[filter_float_price_per_m:from]='. $this->priceByAreaFrom .'&';
        if($this->priceByAreaTo !== null) $url .= 'search[filter_float_price_per_m:to]='. $this->priceByAreaTo .'&';
        if($this->areaFrom !== null) $url .= 'search[filter_float_m:from]='. $this->areaFrom .'&';
        if($this->areaTo !== null) $url .= 'search[filter_float_m:to]='. $this->areaTo .'&';
        $url .= 'search[description]=1&';
        $url .= 'search[dist]=0&';

        $url .= 'search[subregion_id]=127&';
        $url .= 'search[city_id]=1004&';



        $url = rtrim($url, '&');
        return $url;
    }

    /**
     * @param string $url
     * @return string
     */
    public function getHtmlFromUrl($url)
    {
        // TODO: Implement getHtmlFromUrl() method.
    }

    /**
     * @return Objects in array
     */
    public function loadOffersFromPages($options){

    }

    /**
     * @param \DOMDocument $Dom
     * @return Offer
     */
    public function createOfferFromSummary($Dom)
    {
        // TODO: Implement createOfferFromSummary() method.
    }
}