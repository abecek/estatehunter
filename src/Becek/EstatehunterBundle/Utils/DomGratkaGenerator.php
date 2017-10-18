<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 2017-10-18
 * Time: 01:11
 */

namespace Becek\EstatehunterBundle\Utils;

use Symfony\Component\Filesystem\Filesystem;

/**
 * Class DomGratkaGenerator
 * @package Becek\EstatehunterBundle\Utils
 */
class DomGratkaGenerator extends OfferGenerator
{
    /**
     * @var FileSystem
     */
    protected $fileSystem;

    /**
     * @var string
     */
    protected $html;

    public function prepareStringUrlWithOptions($options){
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

        $this->buildingType = $this->buildingType = $options['buildingType'];
        $this->offerType = $this->offerType = $options['offerType'];
        if($this->buildingType == 'dzialki-grunty' && $this->offerType == 'do-wynajecia'){
            $this->offerType = 'do-wydzierzawienia';
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


        if($subregion == '') {
            $localization = $region .','. $town .',';
        }
        else {
            $localization = $region .','. $town .','. $subregion .',';
        }

        $url = 'http://dom.gratka.pl/'. $this->buildingType .'-'. $this->offerType .'/lista/'. $localization;


        if($this->priceFrom !== null){
            $url .= $this->priceFrom .',';
        }
        if($this->priceTo !== null){
            $url .= $this->priceTo .',';
        }

        //STRONY TO DO
        $url .= '40,';
        $url .= '1,';

        $localize = false;
        if($region = '' && $subregion = ''){
            $url .= $town.',';
            $localize = true;
        }

        if($this->priceByAreaFrom !== null){
            $url .= $this->priceByAreaFrom .',';
        }
        if($this->priceByAreaTo !== null){
            $url .= $this->priceByAreaTo .',';
        }
        if($this->areaFrom !== null){
            $url .= $this->areaFrom .',';
        }
        if($this->areaTo !== null){
            $url .= $this->areaTo .',';
        }

        $isAddedByOn = false;
        if($this->addedBy !== null){
            $isAddedByOn = true;
            $url .= 'on,';
        }

        if($isSubRegion){
            $url .= 'p,';
        }


        if($this->priceFrom !== null){
            $url .= 'co,';
        }
        if($this->priceTo !== null){
            $url .= 'cd,';
        }

        $url .= 'li,';
        $url .= 's,';


        if($localize){
            $url .='lok,';
        }

        if($this->priceByAreaFrom !== null){
            $url .= 'cmo,';
        }
        if($this->priceByAreaTo !== null){
            $url .= 'cmd,';
        }
        if($this->areaFrom !== null){
            $url .= 'mo,';
        }
        if($this->areaTo !== null){
            $url .= 'md,';
        }

        if($isAddedByOn) {
            if($this->addedBy == 'estate agencies') {
                $url .= 'za,';
            }
            elseif($this->addedBy == 'newspapers') {
                $url .= 'zg,';
            }
            elseif($this->addedBy == 'private persons') {
                $url .= 'zi,';
            }
            elseif($this->addedBy == 'others') {
                $url .= 'zin,';
            }
        }

        $url = rtrim($url, ',');
        $url .= '.html';

        return $url;
    }

    /**
     * @return Objects in array
     */
    public function loadOffersFromPage($options){
        $this->fileSystem = new Filesystem();
        if(!$this->fileSystem->exists('../tmp')){
            $this->fileSystem->mkdir('../tmp');
        }

        $url = $this->prepareStringUrlWithOptions($options);
        echo "<br>";
        var_dump($url);
        echo "<br>";

        $command = 'wget -R jpg,png,jpeg,gif --accept html '. $url .' -O ../tmp/first.html';
        exec($command);

        $html = file_get_contents('../tmp/first.html');
        $this->dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $this->dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        $this->dom->preserveWhiteSpace = true;
        $this->domX = new \DOMXPath($this->dom);

        $LiOffersById = $this->domX->query("//@id[starts-with(., 'lista-wiersz-')]");
        foreach($LiOffersById as $LiNode){
            $this->offersAsIdsArray[] = $LiNode->value;
        }

        foreach($this->offersAsIdsArray as $id) {
            $liDom = $this->dom->getElementById($id);
            $liHtml = $this->dom->saveHTML($liDom);
            $this->offersAsHtmlArray[] = $liHtml;

            $gratkaOffer = $this->createOfferFromSummary($liDom);
            $this->offersAsObjectsArray[] = $gratkaOffer;
            /*
            var_dump($gratkaOffer->getShortDescription());
            echo '<br>';
            var_dump($gratkaOffer->getRoomCount());
            echo '<br>';
            var_dump($gratkaOffer->getFloor());
            echo '<br>';
            var_dump($gratkaOffer->getFloorCount());
            echo '<br>';
            var_dump($gratkaOffer->getConstructionYear());
            echo '<br>';
            var_dump($gratkaOffer->getPriceByArea());
            echo '<br>';
            var_dump($gratkaOffer->getArea());
            echo '<br>';
            var_dump($gratkaOffer->getSurcharge());
            echo '<br><br>';
            */
        }

        return $this->offersAsObjectsArray;
    }

    /**
     * @param \DOMDocument $liDom
     * @return DomGratkaOffer
     */
    public function createOfferFromSummary($liDom){
        $gratkaOffer = new DomGratkaOffer();

        $summary = $this->domX->query(".//div/div/p", $liDom)->item(0)->textContent;
        $summary = strtolower($summary);
        $gratkaOffer->setShortDescription($summary);

        $price = $this->domX->query(".//div/p/b", $liDom)->item(0)->textContent;
        $price = str_replace(" ", "", $price);
        $price = floatval($price);
        $gratkaOffer->setPrice($price);

        $offerType = $this->domX->query(".//div/em", $liDom)->item(0)->textContent;
        $offerType = substr($offerType, 11);
        $gratkaOffer->setOfferType($offerType);

        $title = $this->domX->query(".//div/h2", $liDom)->item(0)->textContent;
        $gratkaOffer->setTitle($title);


        $roomCount = $this->domX->query(".//div/div/p/span", $liDom)->item(0)->textContent;
        $roomCount = intval($roomCount);
        $gratkaOffer->setRoomCount($roomCount);


        $i = 0;
        if(strpos($summary, "parter") !== false) {
            $floor = 0;
            $i -= 1;
        }
        else {
            $floor = $this->domX->query(".//div/div/p/span", $liDom)->item(1)->textContent;
            $floor = intval($floor);

            $pos = strpos($summary, "piętro z");
            $pos += 11;
            $floorCount = substr($summary, $pos, 2);
            $floorCount = intval($floorCount);
            $gratkaOffer->setFloorCount($floorCount);
        }
        $gratkaOffer->setFloor($floor);


        if(strpos($summary, "budowy") !== false){
            $constructionYear = $this->domX->query(".//div/div/p/span", $liDom)->item(2 + $i)->textContent;
            $constructionYear = intval($constructionYear);
            $gratkaOffer->setConstructionYear($constructionYear);
            $i += 1;
        }

        //DODAC OBSLUGE DZIALEK
        if(strpos($summary, "zł/m2") !== false){
            $priceByArea = $this->domX->query(".//div/div/p/span", $liDom)->item(2 + $i)->textContent;
            $priceByArea .= $this->domX->query(".//div/div/p/span", $liDom)->item(3 + $i)->textContent;
            $priceByArea = floatval($priceByArea);
            $gratkaOffer->setPriceByArea($priceByArea);
        }


        $area = $this->domX->query(".//div/div/p/span/b", $liDom)->item(0)->textContent;
        $area = floatval(str_replace(",", ".",$area));
        $gratkaOffer->setArea($area);

        if(strpos($summary, "dopłata") !== false){
            $surcharge = $this->domX->query(".//div/div/p/span/b", $liDom)->item(1)->textContent;
            $gratkaOffer->setSurcharge($surcharge);
        }

        $description = $this->domX->query(".//div/div/p", $liDom)->item(1)->textContent;
        $gratkaOffer->setDescription($description);

        //var_dump($checking);

        return $gratkaOffer;
    }
}