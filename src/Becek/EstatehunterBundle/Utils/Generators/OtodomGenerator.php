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
     * @var int
     */
    protected $cityId;

    /**
     * @var int
     */
    protected $subregionId;

    /**
     * @var int
     */
    protected $regionId;

    /**
     * @var string
     */
    protected $level;

    /**
     * @var int
     */
    protected static $offersPerPage = 72;

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
     * @return mixed
     */
    public function prepareStringUrlWithOptions($options, $currentPage = 1)
    {
        if(is_array($options) && !empty($options)) {
            isset($options['category']) ? $this->category = $options['category'] : null;
            isset($options['offerType']) ? $this->offerType = $options['offerType'] : null;
            isset($options['priceFrom']) ? $this->priceFrom = $options['priceFrom'] : null;
            isset($options['priceTo']) ? $this->priceTo = $options['priceTo'] : null;
            isset($options['priceByAreaFrom']) ? $this->priceByAreaFrom = $options['priceByAreaFrom'] : null;
            isset($options['priceByAreaTo']) ? $this->priceByAreaTo = $options['priceByAreaTo'] : null;
            isset($options['areaFrom']) ? $this->areaFrom = $options['areaFrom'] : null;
            isset($options['areaTo']) ? $this->areaTo = $options['areaTo'] : null;
            isset($options['localization']) ? $this->localization = $options['localization'] : null;
            isset($options['addedBy']) ? $this->addedBy = $options['addedBy'] : $this->addedBy = null;
            isset($options['cityId']) ? $this->cityId = $options['cityId'] : $this->addedBy = null;
            isset($options['subregionId']) ? $this->subregionId = $options['subregionId'] : $this->addedBy = null;
            isset($options['regionId']) ? $this->regionId = $options['regionId'] : $this->addedBy = null;
            isset($options['level']) ? $this->level = $options['level'] : $this->addedBy = null;
        }

        $town = isset($options['localization']['town']) ? $options['localization']['town'] : '';
        $region = isset($options['localization']['region']) ? $options['localization']['region'] : '';
        $subregion =  $options['localization']['subregion'];

        $url = 'https://www.otodom.pl/'. $this->offerType .'/'. $this->category .'/';
        if($this->cityId != '') {
            $url .= $town .'_'. $this->cityId .'/?';
        }
        else {
            $url .= $town .'?';
        }

        if($this->priceFrom !== null) $url .= 'search[filter_float_price:from]='. $this->priceFrom .'&';
        if($this->priceTo !== null) $url .= 'search[filter_float_price:to]='. $this->priceTo .'&';

        if($this->offerType == 'sprzedaz') {
            if($this->priceByAreaFrom !== null) $url .= 'search[filter_float_price_per_m:from]='. $this->priceByAreaFrom .'&';
            if($this->priceByAreaTo !== null) $url .= 'search[filter_float_price_per_m:to]='. $this->priceByAreaTo .'&';
        }

        if($this->areaFrom !== null) $url .= 'search[filter_float_m:from]='. $this->areaFrom .'&';
        if($this->areaTo !== null) $url .= 'search[filter_float_m:to]='. $this->areaTo .'&';

        $url .= 'search[description]=1&';
        if($this->addedBy === 'private persons'){
            $url .= 'search[private_business]=private&';
        }
        $url .= 'search[dist]=0&';
        $url .= 'search[subregion_id]='. $this->subregionId .'&';
        $url .= 'search[city_id]='. $this->cityId .'&';

        $url .= '&nrAdsPerPage='. $this->getOffersPerPage() .'&';
        if($currentPage != 1) {
            $url .= 'page=' . $currentPage;
        }

        $url = rtrim($url, '?');
        $url = rtrim($url, '&');

        return $url;
    }

    /**
     * @param string $url
     * @return string
     */
    public function getHtmlFromUrl($url)
    {
        // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $headers = array();
        $headers[] = "Accept-Encoding: gzip, deflate, br";
        $headers[] = "Accept-Language: pl-PL,pl;q=0.8,en-US;q=0.6,en;q=0.4";
        $headers[] = "Upgrade-Insecure-Requests: 1";
        $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36";
        $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
        $headers[] = "Cache-Control: max-age=0";
        $headers[] = "Referer: http://otodom.pl/";
        //$headers[] = "Cookie: __gfp_64b=dWbRmj0wp44nADkYHJBOtezPu3d2iKXxZeVkTD..Dzr.m7; optimizelyEndUserId=oeu1508111659215r0.8812146601196635; _cmuid=7b53e6e3-4622-4f61-8203-2e2b382716a3; __gads=ID=9e9d7c034d5f80c0:T=1508111678:S=ALNI_MY76I4IvVZ9GzMVzqeaf8kVtpgS4Q; mobileappsbadge=1; cookieBarSeen=true; PHPSESSID=r2iiklflvhnbrq6dcou8s0ubc7; mobile_default=desktop; newrelicInited=0; ldTd=true; _dc_gtm_UA-3366981-1=1; fonce_current_session=1; fonce_current_day=1,2017-10-20; fonce_current_user=1; optimizelySegments=^%^7B^%^222105660096^%^22^%^3A^%^22gc^%^22^%^2C^%^222106010045^%^22^%^3A^%^22false^%^22^%^2C^%^222110010055^%^22^%^3A^%^22referral^%^22^%^2C^%^222110550062^%^22^%^3A^%^22none^%^22^%^7D; optimizelyBuckets=^%^7B^%^228933370071^%^22^%^3A^%^220^%^22^%^7D; _ga=GA1.2.1945782446.1508111660; _gid=GA1.2.414471088.1508435879; onap=15f2275b080x34aec21b-7-15f36910c21xda702cd-39-1508453736; mp_5da98ecd30a0b9103c5c42f2d2c5575b_mixpanel=^%^7B^%^22distinct_id^%^22^%^3A^%^20^%^2215f2275b1e86c4-0e80b7e72ec091-3b3e5906-140000-15f2275b1e95c3^%^22^%^2C^%^22^%^24initial_referrer^%^22^%^3A^%^20^%^22^%^24direct^%^22^%^2C^%^22^%^24initial_referring_domain^%^22^%^3A^%^20^%^22^%^24direct^%^22^%^2C^%^22^%^24search_engine^%^22^%^3A^%^20^%^22google^%^22^%^7D; OX_plg=pm";
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
    public function loadOffersFromPages($options)
    {
        $currentPage = 1;
        while($currentPage <= $this->pagesCount) {

            $url = $this->prepareStringUrlWithOptions($options, $currentPage);
            var_dump($url);
            echo "<br><br>";

            $this->html = $this->getHtmlFromUrl($url);
            $this->dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $this->dom->loadHTML(mb_convert_encoding($this->html, 'HTML-ENTITIES', 'UTF-8'));
            //$this->dom->preserveWhiteSpace = true;
            $this->domX = new \DOMXPath($this->dom);

            if($currentPage == 1) {
                $pagesCount = $this->domX->query('//strong[@class="current"]')->item(0);
                if($pagesCount !== null) {
                    $this->pagesCount = intval($pagesCount->textContent);
                }
                else{
                    $this->pagesCount = 1;
                }
            }

            $allArticlesWithOffers = $this->domX->query('//div[@class="col-md-content"]/article');

            $temp = array();
            foreach($allArticlesWithOffers as $article){
                $offerId = $article->attributes->item(1)->textContent;
                if(!in_array($offerId, $temp)) {
                    $temp[] = $offerId;
                }
            }

            foreach($temp as $id) {
                $otodomOffer = $this->createOfferFromSummary($id);
                $this->offersAsObjectsArray[$id] = $otodomOffer;
            }

            $currentPage += 1;
        }
        $this->offersAsIdsArray = array_keys($this->offersAsObjectsArray);

        return $this->offersAsObjectsArray;
    }

    /**
     * @param \DOMDocument $Dom
     * @return Offer
     */
    public function createOfferFromSummary($id)
    {
        $otodomOffer = new OtodomOffer();
        //$id = $dom->getAttribute('data-item-id');
        $dom = $this->domX->query("//article[@data-item-id='". $id ."']")->item(0);

        if($dom !== null) {
            $otodomOffer->setIdOffer($id);
            $title = $this->domX->query("//article[@data-item-id='". $id ."']/div/header/h3/a/span/span")->item(0);
            if($title !== null) {
                $title = $title->textContent;
                $otodomOffer->setTitle($title);
            }

            $summary = $dom->textContent;
            $summary = strtolower($summary);
            $otodomOffer->setShortDescription($summary);

            $roomsCount = $this->domX->query("//article[@data-item-id='". $id ."']/div/ul/li")->item(0);
            if($roomsCount !== null) {
                $roomsCount = $roomsCount->textContent;
                if($roomsCount == '>10 pokoi') {
                    $otodomOffer->setRoomCount(10);
                }
                else {
                    $otodomOffer->setRoomCount(intval($roomsCount));
                }
            }

            $price = $this->domX->query("//article[@data-item-id='". $id ."']/div/ul/li")->item(1);
            if($price !== null) {
                $price = $price->textContent;
                $price = str_replace(" ", "", $price);
                $price = floatval($price);
                $otodomOffer->setPrice($price);
            }

            $area = $this->domX->query("//article[@data-item-id='". $id ."']/div/ul/li")->item(2);
            if($area !== null) {
                $area = $area->textContent;
                $area = floatval(str_replace(",", ".", $area));
                $otodomOffer->setArea($area);
                if($this->category === 'dom' && $area != 0 && $this->offerType != 'wynajem') {
                    $priceByHouseArea = $otodomOffer->getPrice() / $area;
                    $otodomOffer->setPriceByArea(round($priceByHouseArea, 2));
                }
            }

            if($this->category === 'mieszkanie') {
                $priceByArea = $this->domX->query("//article[@data-item-id='". $id ."']/div/ul/li")->item(3);
                if($priceByArea !== null && $this->offerType != 'wynajem') {
                    $priceByArea = $priceByArea->textContent;
                    $priceByArea = str_replace(",", ".", $priceByArea);
                    $priceByArea = floatval(str_replace(" ", "", $priceByArea));
                    $otodomOffer->setPriceByArea($priceByArea);
                }
            }
            elseif($this->category === 'dom') {
                $groundArea = $this->domX->query("//article[@data-item-id='". $id ."']/div/ul/li")->item(3);
                if($groundArea !== null) {
                    $groundArea = $groundArea->textContent;
                    $groundArea = str_replace("działka", "", $groundArea);
                    //$groundArea = floatval(str_replace("m²", "", $groundArea));
                    $groundArea = str_replace(" ", "", $groundArea);
                    $otodomOffer->setGroundArea(floatval($groundArea));
                }
            }

            $data = null;
            $rest = $this->domX->query("//article[@data-item-id='". $id ."']/div[@class='offer-item-details-bottom']/ul")->item(0);

            if($rest === null) {
                $rest = $this->domX->query("//article[@data-item-id='". $id ."']/div/ul")->item(1);
                echo 'KABUMM';
            }

            if($rest !== null) {
                $data = preg_split('/\s+/', $rest->textContent, -1, PREG_SPLIT_NO_EMPTY);
                //$data = explode(" ", $rest->textContent);
                /*
                //var_dump($rest->textContent);
                if(count($data) >= 8){
                   // var_dump($rest->textContent);
                    //echo '<br>';
                    //var_dump($data);
                    //echo '<br><br>';
                }
                */

                //FLATS
                if($this->category === 'mieszkanie') {
                    $checkFloor = array_search('parter', $data);
                    if($checkFloor !== false) {
                        $otodomOffer->setFloor(0);
                    }
                    else{
                        $checkFloor = array_search('Piętro', $data);
                        if(is_numeric($checkFloor)) {
                            $otodomOffer->setFloor(intval($data[$checkFloor+1]));
                        }
                    }

                    $temp = array('blok', 'apartamentowiec', 'loft', 'kamienica', 'szeregowiec');
                    foreach($temp as $item){
                        $check = $this->isStringInArrays($data, $item);
                        if($check !== false){
                            $otodomOffer->setBuildingType($item);
                        }
                    }

                    $checkFloorCount = array_search('(z',$data);
                    if($checkFloorCount !== false) {
                        $otodomOffer->setFloorCount(intval($data[$checkFloorCount+1]));
                    }

                    $checkConstructionYear = array_search('r.', $data);
                    if($checkConstructionYear !== false) {
                        $otodomOffer->setConstructionYear(intval($data[$checkConstructionYear-1]));
                    }
                }
                //HOUSES
                elseif($this->category === 'dom') {
                    $checkFloorCount = strpos($data[0], 'parterowy');
                    if($checkFloorCount !== false) {
                        //one floor
                        $otodomOffer->setFloorCount(1);
                    }
                    else {
                        //more floors
                        if(isset($data[1])) {
                            $checkFloorCount = strpos($data[1], 'piętr');
                            if($checkFloorCount !== false) {
                                $otodomOffer->setFloorCount(intval($data[0])+1);
                            }
                        }
                        /*
                         * debugging
                        else{
                            $flag = true;
                            var_dump($data);
                            echo '<br>';
                        }
                        */
                    }

                    $temp = array('wolnostojący', 'szeregowiec', 'bliźniak', 'kamienica', 'dworek/pałac', 'gospodarstwo');
                    foreach($temp as $item){
                        $check = $this->isStringInArrays($data, $item);
                        if($check !== false){
                            $otodomOffer->setBuildingType($item);
                        }
                    }

                    $temp = array('cegła', 'drewno', 'pustak', 'keramzyt', 'wielka płyta', 'beton', 'silikat', 'beton komórkowy', 'inne');
                    foreach($temp as $item){
                        $check = $this->isStringInArrays($data, $item);
                        if($check !== false){
                            $otodomOffer->setConstructionMaterial($item);
                        }
                    }
                }

                $otodomOffer->setAddedBy($this->addedBy);
                $addedByCheck = strpos($rest->textContent, 'prywatna');
                if($addedByCheck !== false){
                    $otodomOffer->setAddedBy('private person');
                }
            }

            $otodomOffer->setOfferType($this->offerType);
            $otodomOffer->setLocalization($this->localization);
            $otodomOffer->setCategory($this->category);

        }

        return $otodomOffer;
    }
}