<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 2017-10-18
 * Time: 01:11
 */

namespace Becek\EstatehunterBundle\Utils\Generators;

use Becek\EstatehunterBundle\Utils\Interfaces\OfferGeneratorInterface;
use Becek\EstatehunterBundle\Utils\DomGratkaOffer;

/**
 * Class DomGratkaGenerator
 * @package Becek\EstatehunterBundle\Utils
 */
class DomGratkaGenerator extends OfferGenerator implements OfferGeneratorInterface
{
    /**
     * @var int
     */
    protected static $offersPerPage = 40;

    /**
     * @var int|null
     */
    protected $pagesCount = 2147483647;

    /**
     * @var int|null
     */
    protected $offersCount = null;


    /**
     * @var string
     */
    protected $html;

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
        $headers[] = "Referer: http://dom.gratka.pl/mieszkania-sprzedam/lista/lodzkie,zgierz,zgierski,p.html";
        $headers[] = "Cookie: __gfp_64b=zMd1P3VHrnG2JDCSVUezQ7TGGuJlCQPzG5XNRwcq7.n.C7; cookie_uzytkownika=596ac0e66b6ee8.54309838; aid=596ac0a27d34e7.03687362; __gads=ID=13c70cf163ee7f2a:T=1508110722:S=ALNI_MYIrJiIllgEctAOHPFJbfLzfeXHIA; polityka_prywatnosci_cookies=true; __utmt=1; _gat_UA-55523259-1=1; _gat_UA-65636444-2=1; _gat_UA-65636444-6=1; searchExpanded=true; kryteria_wyszukiwania=^%^7B^%^22nazwa_formularza^%^22^%^3A^%^22mieszkania-sprzedam^%^22^%^2C^%^22parametry^%^22^%^3A^%^7B^%^22re^%^22^%^3A^%^22lodzkie^%^22^%^2C^%^22m^%^22^%^3A^%^22zgierz^%^22^%^2C^%^22gs^%^22^%^3A^%^22^%^22^%^2C^%^22rs^%^22^%^3A^%^22^%^22^%^2C^%^22ul^%^22^%^3A^%^22^%^22^%^2C^%^22g^%^22^%^3A^%^22^%^22^%^2C^%^22p^%^22^%^3A^%^22zgierski^%^22^%^2C^%^22dz^%^22^%^3A^%^22^%^22^%^2C^%^22co^%^22^%^3A^%^22^%^22^%^2C^%^22cd^%^22^%^3A^%^22^%^22^%^2C^%^22od^%^22^%^3A^%^22^%^22^%^2C^%^22os^%^22^%^3A^%^22^%^22^%^2C^%^22sk^%^22^%^3A^%^22^%^22^%^2C^%^22tz^%^22^%^3A^%^22^%^22^%^2C^%^22tw^%^22^%^3A^%^22^%^22^%^2C^%^22twr^%^22^%^3A^%^22^%^22^%^2C^%^22tnwr^%^22^%^3A^%^22^%^22^%^2C^%^22pfpp^%^22^%^3A^%^22^%^22^%^2C^%^22ptmo^%^22^%^3A^%^22^%^22^%^2C^%^22ta^%^22^%^3A^%^22^%^22^%^2C^%^22tzb^%^22^%^3A^%^22^%^22^%^2C^%^22tpl^%^22^%^3A^%^22^%^22^%^2C^%^22tmdm^%^22^%^3A^%^22^%^22^%^2C^%^22twsp^%^22^%^3A^%^22^%^22^%^2C^%^22nwsp^%^22^%^3A^%^22^%^22^%^2C^%^22nwy^%^22^%^3A^%^22^%^22^%^2C^%^22li^%^22^%^3A^%^22^%^22^%^2C^%^22sr^%^22^%^3A^%^22^%^22^%^2C^%^22ddd^%^22^%^3A^%^22^%^22^%^2C^%^22taw^%^22^%^3A^%^22^%^22^%^2C^%^22lnm^%^22^%^3A^%^22^%^22^%^2C^%^22lok^%^22^%^3A^%^22^%^22^%^2C^%^22wsm^%^22^%^3A^%^22^%^22^%^2C^%^22wsk^%^22^%^3A^%^22^%^22^%^2C^%^22s^%^22^%^3A^%^22^%^22^%^2C^%^22cw^%^22^%^3A^%^221^%^22^%^2C^%^22cmo^%^22^%^3A^%^22^%^22^%^2C^%^22cmd^%^22^%^3A^%^22^%^22^%^2C^%^22fi^%^22^%^3A^%^22^%^22^%^2C^%^22mo^%^22^%^3A^%^22^%^22^%^2C^%^22md^%^22^%^3A^%^22^%^22^%^2C^%^22no^%^22^%^3A^%^22^%^22^%^2C^%^22zi^%^22^%^3A^%^22^%^22^%^2C^%^22zg^%^22^%^3A^%^22^%^22^%^2C^%^22za^%^22^%^3A^%^22^%^22^%^2C^%^22zd^%^22^%^3A^%^22^%^22^%^2C^%^22zin^%^22^%^3A^%^22^%^22^%^2C^%^22pz^%^22^%^3A^%^22^%^22^%^2C^%^22rzw^%^22^%^3A^%^22^%^22^%^2C^%^22inne^%^22^%^3A^%^22^%^22^%^2C^%^22sudz^%^22^%^3A^%^22^%^22^%^2C^%^22bezsudz^%^22^%^3A^%^22^%^22^%^2C^%^22lp^%^22^%^3A^%^22^%^22^%^2C^%^22lpo^%^22^%^3A^%^22^%^22^%^2C^%^22lpd^%^22^%^3A^%^22^%^22^%^2C^%^22lo^%^22^%^3A^%^22^%^22^%^2C^%^22ld^%^22^%^3A^%^22^%^22^%^2C^%^22po^%^22^%^3A^%^22^%^22^%^2C^%^22pd^%^22^%^3A^%^22^%^22^%^2C^%^22lpz^%^22^%^3A^%^22^%^22^%^2C^%^22pod^%^22^%^3A^%^22^%^22^%^2C^%^22tb^%^22^%^3A^%^22^%^22^%^2C^%^22twy^%^22^%^3A^%^22^%^22^%^2C^%^22ga^%^22^%^3A^%^22^%^22^%^2C^%^22rbo^%^22^%^3A^%^22^%^22^%^2C^%^22rbd^%^22^%^3A^%^22^%^22^%^2C^%^22fw^%^22^%^3A^%^22^%^22^%^2C^%^22ini^%^22^%^3A^%^22^%^22^%^2C^%^22tp^%^22^%^3A^%^22^%^22^%^7D^%^7D; miasto=Zgierz; region=lodzkie; _gac_UA-65636444-2=1.1508112890.EAIaIQobChMIhbrBnObz1gIVywrTCh2SkwHKEAAYASAAEgKEKPD_BwE; _ga=GA1.2.1065118594.1500166559; _gid=GA1.2.610633140.1508425996; _gac_UA-65636444-6=1.1508112890.EAIaIQobChMIhbrBnObz1gIVywrTCh2SkwHKEAAYASAAEgKEKPD_BwE; __goadservices=3-alWnxSGSlPVMGTYz0kIed8_0mTd7WY5ii7PsINcQMBo; __utma=239465948.1065118594.1500166559.1508298122.1508425996.13; __utmb=239465948.2.10.1508425996; __utmc=239465948; __utmz=239465948.1508207783.7.3.utmcsr=google^|utmccn=(organic)^|utmcmd=organic^|utmctr=(not^%^20provided); _gac_UA-969241-2=1.1508110715.EAIaIQobChMIhbrBnObz1gIVywrTCh2SkwHKEAAYASAAEgKEKPD_BwE; sesja_gratka=47b308999f1e48355e814e69bf62cbc5; serwis_ostatni=GRATKA_DOM; debug=a^%^3A0^%^3A^%^7B^%^7D; _gac_UA-55523259-1=1.1508112890.EAIaIQobChMIhbrBnObz1gIVywrTCh2SkwHKEAAYASAAEgKEKPD_BwE; _gac_UA-65636444-2=1.1508112890.EAIaIQobChMIhbrBnObz1gIVywrTCh2SkwHKEAAYASAAEgKEKPD_BwE; _ga=GA1.3.1065118594.1500166559; _gid=GA1.3.610633140.1508425996; _gac_UA-65636444-6=1.1508112890.EAIaIQobChMIhbrBnObz1gIVywrTCh2SkwHKEAAYASAAEgKEKPD_BwE";
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
     * @return Objects in array
     */
    public function loadOffersFromPages($options){

        $currentPage = 1;
        while($currentPage <= $this->pagesCount){
            $url = $this->prepareStringUrlWithOptions($options, $currentPage);
            var_dump($url);
            echo "<br>";

            $html = $this->getHtmlFromUrl($url);
            $this->html = $html;
            $this->dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $this->dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
            //$this->dom->preserveWhiteSpace = true;
            $this->domX = new \DOMXPath($this->dom);

            if($currentPage == 1){
                $this->offersCount = intval($this->domX->query("//div[@id='ogloszenia']/div/div/span/b")->item(0)->textContent);
                $this->pagesCount = intval(ceil($this->offersCount / $this->getOffersPerPage()));
            }

            $LiOffersById = $this->domX->query("//@id[starts-with(., 'lista-wiersz-')]");
            $temp = array();
            foreach($LiOffersById as $LiNode){
                $this->offersAsIdsArray[] = $LiNode->value;
                $temp[] = $LiNode->value;
            }

            foreach($temp as $id) {
                $liDom = $this->dom->getElementById($id);
                $gratkaOffer = $this->createOfferFromSummary($liDom);
                $this->offersAsObjectsArray[] = $gratkaOffer;
            }

            $currentPage += 1;
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