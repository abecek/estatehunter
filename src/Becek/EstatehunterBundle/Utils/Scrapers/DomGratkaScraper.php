<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 2017-10-18
 * Time: 01:11
 */

namespace Becek\EstatehunterBundle\Utils\Scrapers;

use Becek\EstatehunterBundle\Utils\Interfaces\OfferGeneratorInterface;
use Becek\EstatehunterBundle\Utils\DomGratkaOffer;

/**
 * Class DomGratkaScraper
 * @package Becek\EstatehunterBundle\Utils\Scrapers
 */
class DomGratkaScraper extends OfferScraperAbstract implements OfferGeneratorInterface
{
    /**
     * @var int
     */
    protected static $offersPerPage = 32;

    /**
     * @var int|null
     */
    protected $pagesCount = 2147483647;

    /**
     * @var int|null
     */
    protected $offersCount = null;

    /**
     * @return int
     */
    public static function getOffersPerPage()
    {
        return self::$offersPerPage;
    }

    /**
     * @param array $options
     * @param int $currentPage
     * @return string
     */
    public function prepareStringUrlWithOptions($options, $currentPage = 1){
        if(is_array($options) && !empty($options)){
            isset($options['category']) ? $this->category = $options['category'] : null;
            isset($options['offerType']) ? $this->offerType = $options['offerType'] : null;
            isset($options['priceFrom']) ? $this->priceFrom = $options['priceFrom'] : null;
            isset($options['priceTo']) ? $this->priceTo = $options['priceTo'] : null;
            if($this->offerType != 'do-wynajecia') {
                isset($options['priceByAreaFrom']) ? $this->priceByAreaFrom = $options['priceByAreaFrom'] : null;
                isset($options['priceByAreaTo']) ? $this->priceByAreaTo = $options['priceByAreaTo'] : null;
            }
            isset($options['areaFrom']) ? $this->areaFrom = $options['areaFrom'] : null;
            isset($options['areaTo']) ? $this->areaTo = $options['areaTo'] : null;
            isset($options['localization']) ? $this->localization = $options['localization'] : null;
            isset($options['addedBy']) ? $this->addedBy = $options['addedBy'] : $this->addedBy = null;
        }

        /*
         * OLD CODE
        if($this->category == 'dzialki-grunty' && $this->offerType == 'do-wynajecia') {
            $this->offerType = 'do-wydzierzawienia';
        }
        */

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

        $url = 'https://gratka.pl/nieruchomosci/'. $this->category . '/';


        if($town != '') {
            $url .=  $town . '?';
        }
        if($region != '') {
            $url .= 'lokalizacja_region=' . $region . '&';
        }
        //var_dump($region);


        if($this->offerType != null) {
            $url .= 'rodzaj-ogloszenia=' . $this->offerType . '&';
        }


        if($this->priceByAreaFrom != null) {
            $url .= 'cena-za-m2:min=' . $this->priceByAreaFrom . '&';
        }
        if($this->priceByAreaTo != null) {
            $url .= 'cena-za-m2:max=' . $this->priceByAreaTo . '&';
        }


        if($this->areaFrom != null) {
            $url .= 'powierzchnia-w-m2:min=' . $this->areaFrom . '&';
        }
        if($this->areaTo != null) {
            $url .= 'powierzchnia-w-m2:max=' . $this->areaTo . '&';
        }


        if($this->priceFrom != null) {
            $url .= 'cena-calkowita:min=' . $this->priceFrom . '&';
        }
        if($this->priceTo != null) {
            $url .= 'cena-calkowita:max=' . $this->priceTo . '&';
        }




        /*
         * OLD CODE(before changes on gratka.pl)
         *
        if($subregion == '') {
            $localization = $region .','. $town .',,';
        }
        else {
            $localization = $region .','. $town .','. $subregion .',';
        }

        $url = 'http://dom.gratka.pl/'. $this->category .'-'. $this->offerType .'/lista/'. $localization;

        if($this->priceFrom !== null) {
            $url .= $this->priceFrom .',';
        }
        if($this->priceTo !== null) {
            $url .= $this->priceTo .',';
        }

        //PAGE NUMBER
        $url .= $this->getOffersPerPage() .',';
        $url .= $currentPage .',';

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

        //Consts vars for choosing page
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
        */



        $url = rtrim($url, '&');
        //var_dump($url);
        //exit;

        return $url;
    }

    /**
     * @param string $url
     * @return string
     */
    public function getHtmlFromUrl($url){
        // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = "Accept-Encoding: gzip, deflate";
        $headers[] = "Accept-Language: pl-PL,pl;q=0.8,en-US;q=0.6,en;q=0.4";
        $headers[] = "Upgrade-Insecure-Requests: 1";
        $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36";
        $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
        $headers[] = "Referer: http://dom.gratka.pl/";
        //$headers[] = "Cookie: __gfp_64b=zMd1P3VHrnG2JDCSVUezQ7TGGuJlCQPzG5XNRwcq7.n.C7; cookie_uzytkownika=596ac0e66b6ee8.54309838; aid=596ac0a27d34e7.03687362; __gads=ID=13c70cf163ee7f2a:T=1508110722:S=ALNI_MYIrJiIllgEctAOHPFJbfLzfeXHIA; polityka_prywatnosci_cookies=true; __utmt=1; _gat_UA-55523259-1=1; _gat_UA-65636444-2=1; _gat_UA-65636444-6=1; searchExpanded=true; kryteria_wyszukiwania=^%^7B^%^22nazwa_formularza^%^22^%^3A^%^22mieszkania-sprzedam^%^22^%^2C^%^22parametry^%^22^%^3A^%^7B^%^22re^%^22^%^3A^%^22lodzkie^%^22^%^2C^%^22m^%^22^%^3A^%^22zgierz^%^22^%^2C^%^22gs^%^22^%^3A^%^22^%^22^%^2C^%^22rs^%^22^%^3A^%^22^%^22^%^2C^%^22ul^%^22^%^3A^%^22^%^22^%^2C^%^22g^%^22^%^3A^%^22^%^22^%^2C^%^22p^%^22^%^3A^%^22zgierski^%^22^%^2C^%^22dz^%^22^%^3A^%^22^%^22^%^2C^%^22co^%^22^%^3A^%^22^%^22^%^2C^%^22cd^%^22^%^3A^%^22^%^22^%^2C^%^22od^%^22^%^3A^%^22^%^22^%^2C^%^22os^%^22^%^3A^%^22^%^22^%^2C^%^22sk^%^22^%^3A^%^22^%^22^%^2C^%^22tz^%^22^%^3A^%^22^%^22^%^2C^%^22tw^%^22^%^3A^%^22^%^22^%^2C^%^22twr^%^22^%^3A^%^22^%^22^%^2C^%^22tnwr^%^22^%^3A^%^22^%^22^%^2C^%^22pfpp^%^22^%^3A^%^22^%^22^%^2C^%^22ptmo^%^22^%^3A^%^22^%^22^%^2C^%^22ta^%^22^%^3A^%^22^%^22^%^2C^%^22tzb^%^22^%^3A^%^22^%^22^%^2C^%^22tpl^%^22^%^3A^%^22^%^22^%^2C^%^22tmdm^%^22^%^3A^%^22^%^22^%^2C^%^22twsp^%^22^%^3A^%^22^%^22^%^2C^%^22nwsp^%^22^%^3A^%^22^%^22^%^2C^%^22nwy^%^22^%^3A^%^22^%^22^%^2C^%^22li^%^22^%^3A^%^22^%^22^%^2C^%^22sr^%^22^%^3A^%^22^%^22^%^2C^%^22ddd^%^22^%^3A^%^22^%^22^%^2C^%^22taw^%^22^%^3A^%^22^%^22^%^2C^%^22lnm^%^22^%^3A^%^22^%^22^%^2C^%^22lok^%^22^%^3A^%^22^%^22^%^2C^%^22wsm^%^22^%^3A^%^22^%^22^%^2C^%^22wsk^%^22^%^3A^%^22^%^22^%^2C^%^22s^%^22^%^3A^%^22^%^22^%^2C^%^22cw^%^22^%^3A^%^221^%^22^%^2C^%^22cmo^%^22^%^3A^%^22^%^22^%^2C^%^22cmd^%^22^%^3A^%^22^%^22^%^2C^%^22fi^%^22^%^3A^%^22^%^22^%^2C^%^22mo^%^22^%^3A^%^22^%^22^%^2C^%^22md^%^22^%^3A^%^22^%^22^%^2C^%^22no^%^22^%^3A^%^22^%^22^%^2C^%^22zi^%^22^%^3A^%^22^%^22^%^2C^%^22zg^%^22^%^3A^%^22^%^22^%^2C^%^22za^%^22^%^3A^%^22^%^22^%^2C^%^22zd^%^22^%^3A^%^22^%^22^%^2C^%^22zin^%^22^%^3A^%^22^%^22^%^2C^%^22pz^%^22^%^3A^%^22^%^22^%^2C^%^22rzw^%^22^%^3A^%^22^%^22^%^2C^%^22inne^%^22^%^3A^%^22^%^22^%^2C^%^22sudz^%^22^%^3A^%^22^%^22^%^2C^%^22bezsudz^%^22^%^3A^%^22^%^22^%^2C^%^22lp^%^22^%^3A^%^22^%^22^%^2C^%^22lpo^%^22^%^3A^%^22^%^22^%^2C^%^22lpd^%^22^%^3A^%^22^%^22^%^2C^%^22lo^%^22^%^3A^%^22^%^22^%^2C^%^22ld^%^22^%^3A^%^22^%^22^%^2C^%^22po^%^22^%^3A^%^22^%^22^%^2C^%^22pd^%^22^%^3A^%^22^%^22^%^2C^%^22lpz^%^22^%^3A^%^22^%^22^%^2C^%^22pod^%^22^%^3A^%^22^%^22^%^2C^%^22tb^%^22^%^3A^%^22^%^22^%^2C^%^22twy^%^22^%^3A^%^22^%^22^%^2C^%^22ga^%^22^%^3A^%^22^%^22^%^2C^%^22rbo^%^22^%^3A^%^22^%^22^%^2C^%^22rbd^%^22^%^3A^%^22^%^22^%^2C^%^22fw^%^22^%^3A^%^22^%^22^%^2C^%^22ini^%^22^%^3A^%^22^%^22^%^2C^%^22tp^%^22^%^3A^%^22^%^22^%^7D^%^7D; miasto=Zgierz; region=lodzkie; _gac_UA-65636444-2=1.1508112890.EAIaIQobChMIhbrBnObz1gIVywrTCh2SkwHKEAAYASAAEgKEKPD_BwE; _ga=GA1.2.1065118594.1500166559; _gid=GA1.2.610633140.1508425996; _gac_UA-65636444-6=1.1508112890.EAIaIQobChMIhbrBnObz1gIVywrTCh2SkwHKEAAYASAAEgKEKPD_BwE; __goadservices=3-alWnxSGSlPVMGTYz0kIed8_0mTd7WY5ii7PsINcQMBo; __utma=239465948.1065118594.1500166559.1508298122.1508425996.13; __utmb=239465948.2.10.1508425996; __utmc=239465948; __utmz=239465948.1508207783.7.3.utmcsr=google^|utmccn=(organic)^|utmcmd=organic^|utmctr=(not^%^20provided); _gac_UA-969241-2=1.1508110715.EAIaIQobChMIhbrBnObz1gIVywrTCh2SkwHKEAAYASAAEgKEKPD_BwE; sesja_gratka=47b308999f1e48355e814e69bf62cbc5; serwis_ostatni=GRATKA_DOM; debug=a^%^3A0^%^3A^%^7B^%^7D; _gac_UA-55523259-1=1.1508112890.EAIaIQobChMIhbrBnObz1gIVywrTCh2SkwHKEAAYASAAEgKEKPD_BwE; _gac_UA-65636444-2=1.1508112890.EAIaIQobChMIhbrBnObz1gIVywrTCh2SkwHKEAAYASAAEgKEKPD_BwE; _ga=GA1.3.1065118594.1500166559; _gid=GA1.3.610633140.1508425996; _gac_UA-65636444-6=1.1508112890.EAIaIQobChMIhbrBnObz1gIVywrTCh2SkwHKEAAYASAAEgKEKPD_BwE";
        $headers[] = "Connection: keep-alive";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);

        return $result;
    }

    /**
     * @param $options
     * @return Objects in array
     */
    public function loadOffersFromPages($options){

        $currentPage = 1;
        while($currentPage <= $this->pagesCount){
            $url = $this->prepareStringUrlWithOptions($options, $currentPage);
            var_dump($url);
            echo "<br>";

            $html = $this->getHtmlFromUrl($url);
            $this->dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $this->dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
            //$this->dom->preserveWhiteSpace = true;
            $this->domX = new \DOMXPath($this->dom);

            if($currentPage == 1){
                $item = $this->domX->query("//div[@class='content__counter']")->item(0);

                if($item != null) {
                    $this->offersCount = intval($item->textContent);
                    $this->pagesCount = intval(ceil($this->offersCount / $this->getOffersPerPage()));
                }
                var_dump($this->offersCount);
                var_dump($this->pagesCount);
            }


            $LiOffersById = $this->domX->query("//@id[starts-with(., 'offer-')]");

            $temp = array();
            foreach($LiOffersById as $LiNode){
                $this->offersAsIdsArray[] = $LiNode->value;
                $temp[] = $LiNode->value;
            }

            foreach($temp as $id) {
                $liDom = $this->dom->getElementById($id);
                $gratkaOffer = $this->createOfferFromSummary($liDom);
                $this->offersAsObjectsArray[$gratkaOffer->getIdOffer()] = $gratkaOffer;

            }

            //array_merge($this->offersAsIdsArray, $temp);
            $currentPage += 1;
        }

        return $this->offersAsObjectsArray;
    }

    /**
     * @param \DOMDocument $liDom
     * @return DomGratkaOffer
     */
    public function createOfferFromSummary($liDom)
    {
        $gratkaOffer = new DomGratkaOffer();
        $id = $liDom->getAttribute('id');
        $id = explode('-', $id);
        $gratkaOffer->setIdOffer($id[1]);

        $price = $this->domX->query(".//div/div/p", $liDom)->item(0)->textContent;
        $price = str_replace(" ", "", $price);
        $price = floatval($price);
        $gratkaOffer->setPrice($price);

        $title = $this->domX->query(".//div/h2", $liDom)->item(0)->textContent;
        $gratkaOffer->setTitle($title);


        $liList = $this->domX->query(".//div/ul", $liDom)->item(0);
        if($liList !== null) {
            $test = $liList->textContent;
            $temp = explode(PHP_EOL, $test);
            //var_dump($temp);
        }

        $roomCount = $this->domX->query(".//div/ul/li", $liDom)->item(1);
        //$roomCount = $this->domX->query("//@id[starts-with(., 'offer-')]");
        if($roomCount !== null) {
            $roomCount = ltrim($roomCount->textContent, ' ');
            $roomCount = intval(ltrim($roomCount, 'Liczba pokoi:'));
            $gratkaOffer->setRoomCount($roomCount);
        }


        $floor = null;
        $floorCount = null;

        if($this->category != 'domy') {
            $pos = $this->isStringInArray($temp, 'parter');
            if($pos !== false) {
                // todo: check it
                echo 'eee ';
                $floor = 0;
            }
            else {
                $pos = $this->isStringInArray($temp, 'Piętro');
                if($pos !== false) {
                    $floor = intval(ltrim(ltrim($temp[$pos], ' '), 'Piętro:'));
                }
            }
            $gratkaOffer->setFloor($floor);


            $pos2 = $this->isStringInArray($temp, 'Liczba pięter w budynku:');
            if($pos2 !== false) {
                $floorCount = intval(ltrim(ltrim($temp[$pos2], ' '), 'Liczba pięter w budynku:'));
                // todo: check it
                $gratkaOffer->setFloorCount(intval($floorCount));
            }

        }
        else {
            // todo: fix houses
            $pos = $this->isStringInArray($temp, 'parterowy');
            if($pos !== false) {
                $gratkaOffer->setFloorCount(0);
            }

            $pos = $this->isStringInArray($temp, 'Piętro');
            if($pos !== false) {
                $floorCount = $temp[$pos];
                $floorCount = intval($floorCount);
                $gratkaOffer->setFloorCount($floorCount);
            }
        }


        $pos = $this->isStringInArray($temp, 'Rok budowy:');
        if($pos !== false) {
            $constructionYear = ltrim($temp[$pos], ' ');
            $constructionYear = intval(ltrim($constructionYear, 'Rok budowy:'));
            $gratkaOffer->setConstructionYear($constructionYear);
        }

        $pos = $this->isStringInArray($temp, 'działki');
        if($pos !== false) {
            $groundArea = $temp[$pos];
            $groundArea = floatval($groundArea);
            $gratkaOffer->setGroundArea($groundArea);
        }

        /*
        $pos = $this->isStringInArray($temp, 'zł/m2');
        if($pos !== false) {
            $priceByArea = $temp[$pos];
            $priceByArea = str_replace(',', '.', $priceByArea);
            $priceByArea = str_replace(' ', '', $priceByArea);
            $priceByArea = floatval($priceByArea);
            $gratkaOffer->setPriceByArea($priceByArea);
        }
        */

        $priceByArea = $this->domX->query(".//div/div/p/span", $liDom)->item(1);
        if($priceByArea !== null) {
            $priceByArea = str_replace(" ", "", $priceByArea->textContent);
            $priceByArea = floatval($priceByArea);
            $gratkaOffer->setPriceByArea($priceByArea);
        }


        $pos = $this->isStringInArray($temp, 'powierzchnia w m2:');
        if($pos !== false) {
            $area = ltrim($temp[$pos], ' ');
            $area = ltrim($area, 'powierzchnia w m2:');
            $area = str_replace(",", ".",$area);
            $area = str_replace(' ', '', $area);
            $area = floatval($area);
            $gratkaOffer->setArea($area);
        }

        if($this->category == 'dzialki-grunty') {
            // todo: fix grounds
            $gratkaOffer->setGroundArea($gratkaOffer->getArea());
            $gratkaOffer->setArea(null);


            $temp2 = array('inwestycyjna', 'przemsyłowa', 'budowlana', 'usługowa');
            var_dump($temp);
            echo '<br>';
            foreach($temp2 as $item){
                $pos = $this->isStringInArrays($temp, $item);
                if($pos !== false) {
                    $gratkaOffer->setBuildingType($item);
                }
            }
        }


        /*
         * DEPRACTED ???
         *
        $pos = $this->isStringInArray($temp, 'dopłata');
        if($pos !== false) {
            $surcharge = $temp[$pos];
            $surcharge = explode(':', $surcharge);
            $surcharge = str_replace(' ', '', $surcharge[1]);
            $gratkaOffer->setSurcharge(intval($surcharge));
        }
        */

        /*
        $description = $this->domX->query(".//div/div/p", $liDom)->item(1)->textContent;
        $gratkaOffer->setDescription($description);
        */


        if($this->category == 'mieszkania') {
            $pos = $this->isStringInArray($temp, 'Typ zabudowy:');
            if($pos !== false) {
                $buildType = ltrim($temp[$pos], ' ');
                $buildType = ltrim($buildType, 'Typ zabudowy');
                $buildType = ltrim($buildType, ': ');
                $gratkaOffer->setBuildingType($buildType);
            }

            /*
             * OLD code
             *
            $temp2 = array('blok', 'apartamentowiec', 'loft', 'kamienica', 'kamienicy', 'szeregowiec');
            //$sumLower = strtolower($description);
            foreach($temp2 as $item){
                $check = strpos($sumLower, $item);
                if($check !== false){
                    if($item = 'kamienicy') $item = 'kamienica';
                    $gratkaOffer->setBuildingType($item);
                }
            }
            */
        }

        /*
        $offerType = $this->domX->query(".//div/em", $liDom)->item(0)->textContent;
        $offerType = substr($offerType, 11);
        */

        $gratkaOffer->setOfferType($this->offerType);
        $gratkaOffer->setAddedBy($this->addedBy);
        $gratkaOffer->setLocalization($this->localization);
        $gratkaOffer->setCategory($this->category);

        //var_dump($checking);

        return $gratkaOffer;
    }
}