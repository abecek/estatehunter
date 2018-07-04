<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 2018-01-31
 * Time: 21:04
 */

namespace Becek\EstatehunterBundle\Utils\Scrapers;

use Becek\EstatehunterBundle\Utils\Interfaces\OfferGeneratorInterface;
use Becek\EstatehunterBundle\Utils\OlxOffer;

/**
 * Class OlxScraper
 * @package Becek\EstatehunterBundle\Utils\Scrapers
 */
class OlxScraper extends OfferScraperAbstract implements OfferGeneratorInterface
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
     * @var int
     */
    protected $offersPerPage = 38;

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

            if($this->offerType != 'wynajem') {
                isset($options['priceByAreaFrom']) ? $this->priceByAreaFrom = $options['priceByAreaFrom'] : null;
                isset($options['priceByAreaTo']) ? $this->priceByAreaTo = $options['priceByAreaTo'] : null;
            }

            isset($options['areaFrom']) ? $this->areaFrom = $options['areaFrom'] : null;
            isset($options['areaTo']) ? $this->areaTo = $options['areaTo'] : null;
            isset($options['localization']) ? $this->localization = $options['localization'] : null;
            isset($options['addedBy']) ? $this->addedBy = $options['addedBy'] : $this->addedBy = null;
            isset($options['cityId']) ? $this->cityId = $options['cityId'] : $this->addedBy = null;
            isset($options['subregionId']) ? $this->subregionId = $options['subregionId'] : $this->addedBy = null;
            isset($options['regionId']) ? $this->regionId = $options['regionId'] : $this->addedBy = null;
        }

        $town = isset($options['localization']['town']) ? $options['localization']['town'] : '';
        $region = isset($options['localization']['region']) ? $options['localization']['region'] : '';
        $subregion =  $options['localization']['subregion'];

        $url = 'https://www.olx.pl/nieruchomosci/' . $this->category . '/' . $this->offerType . '/';
        if($this->cityId != '') {
            $url .= $town .'_'. $this->cityId .'/?';
        }
        else {
            $url .= $town .'/?';
        }

        if($this->priceFrom !== null) $url .= 'search[filter_float_price:from]='. $this->priceFrom .'&';
        if($this->priceTo !== null) $url .= 'search[filter_float_price:to]='. $this->priceTo .'&';

        if($this->priceByAreaFrom !== null) $url .= 'search[filter_float_price_per_m:from]='. $this->priceByAreaFrom .'&';
        if($this->priceByAreaTo !== null) $url .= 'search[filter_float_price_per_m:to]='. $this->priceByAreaTo .'&';

        if($this->areaFrom !== null) $url .= 'search[filter_float_m:from]='. $this->areaFrom .'&';
        if($this->areaTo !== null) $url .= 'search[filter_float_m:to]='. $this->areaTo .'&';

        if($this->addedBy !== null){
            $url .= 'search[private_business]='. $this->addedBy .'&';
        }

        $url .= 'search[dist]=0&';
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
        $headers[] = "Accept-Language: pl-PL,pl;q=0.9,en-US;q=0.8,en;q=0.7";
        $headers[] = "Upgrade-Insecure-Requests: 1";
        $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36";
        $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
        $headers[] = "Cache-Control: max-age=0";
        $headers[] = "Referer: http://otodom.pl/";
        //$headers[] = "Cookie: _ENV['optimizelyEndUserId=oeu1444292837403r0.636262810556218; optimizelySegments=^%^7B^%^22651120031^%^22^%^3A^%^22false^%^22^%^2C^%^22653370018^%^22^%^3A^%^22referral^%^22^%^2C^%^22655780007^%^22^%^3A^%^22gc^%^22^%^2C^%^221082850423^%^22^%^3A^%^22olx^%^22^%^7D; optimizelyBuckets=^%^7B^%^7D; cabtest_test_dfp_native_pl=2; _ga=GA1.2.373993578.1444292837; cookieBarSeen=true; __gfp_64b=sqMcoaWvkTWHV8ftD3XZmshaqyxPTjJUx8hyNIg56gj.r7; __gads=ID=60a8f98e51b4c2a8:T=1502887147:S=ALNI_MYZVsDD3fzidzIrCoYvnAyco_p56g; xtvrn=^507462^509831^removed^; incrementadblock_index_0=true; dfp_user_id=3318f3b2-8e80-28ce-c78b-6924245c2562-ver2; optimizelySegments=^%^7B^%^22651120031^%^22^%^3A^%^22false^%^22^%^2C^%^22653370018^%^22^%^3A^%^22search^%^22^%^2C^%^22655780007^%^22^%^3A^%^22gc^%^22^%^2C^%^221040047185^%^22^%^3A^%^22gc^%^22^%^2C^%^221050556368^%^22^%^3A^%^22false^%^22^%^2C^%^221070751745^%^22^%^3A^%^22referral^%^22^%^2C^%^221074021509^%^22^%^3A^%^22none^%^22^%^2C^%^221082850423^%^22^%^3A^%^22diplaylink^%^22^%^7D; optimizelyBuckets=^%^7B^%^7D; dfp_segment_test_v2=93; dfp_segment_test=95; __utmz=221885126.1508691718.15.6.utmcsr=google^|utmccn=(organic)^|utmcmd=organic^|utmctr=(not^%^20provided); PHPSESSID=daqfthtg4s9bt05ga6go21po80; mobile_default=desktop; newrelicInited=0; ldTd=true; from_detail=0; __utmc=221885126; surveyPopupInited=^%^5B^%^22rollingNPSOLXPLwave1^%^22^%^2C^%^22Survey_PL_AdvertisingEfficiency_JAN2018^%^22^%^5D; __utma=221885126.373993578.1444292837.1517429188.1517429188.19; new_dfp_segment_dfp_id_3318f3b2-8e80-28ce-c78b-6924245c2562-ver2=^%^5B^%^22t000^%^22^%^2C^%^22t019^%^22^%^5D; observed_id=131952109; sawSaveLayer=1; __utmt=1; last_locations=10609-0-0-^%^C5^%^81^%^C3^%^B3d^%^C5^%^BA-^%^C5^%^81^%^C3^%^B3dzkie-lodz_59837-0-0-Zgierz-zgierski-zgierz_77881-0-0-Zgierz-s^%^C5^%^82upski-zgierz^%^3B77881; my_city_2=10609_0_0_^%^C5^%^81^%^C3^%^B3d^%^C5^%^BA_0_^%^C5^%^81^%^C3^%^B3dzkie_lodz; onap=150468fb7c7x4bc6d0a1-18-1614e0cad35x23f93f0e-168-1517437983-dies=63; mp_c04f254e1667e60a2e84a85c66650e16_mixpanel=^%^7B^%^22distinct_id^%^22^%^3A^%^20^%^2215be42a4e7f2d0-0a55364d94add9-4e47052e-140000-15be42a4e804d3^%^22^%^2C^%^22^%^24initial_referrer^%^22^%^3A^%^20^%^22https^%^3A^%^2F^%^2Fwww.facebook.com^%^2F^%^22^%^2C^%^22^%^24initial_referring_domain^%^22^%^3A^%^20^%^22www.facebook.com^%^22^%^2C^%^22^%^24search_engine^%^22^%^3A^%^20^%^22google^%^22^%^7D; __utmb=221885126.73.9.1517434119966']";
        $headers[] = "Connection: keep-alive";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            var_dump(curl_getinfo($ch));
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);

        return $result;
    }

    /**
     * @param $options
     * @return Objects in array
     */
    public function loadOffersFromPages($options)
    {
        $currentPage = 1;
        while($currentPage <= $this->pagesCount) {

            $url = $this->prepareStringUrlWithOptions($options, $currentPage);
            var_dump($url);
            echo "<br>";

            $this->html = $this->getHtmlFromUrl($url);
            $this->dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $this->dom->loadHTML(mb_convert_encoding($this->html, 'HTML-ENTITIES', 'UTF-8'));
            //$this->dom->preserveWhiteSpace = true;
            $this->domX = new \DOMXPath($this->dom);

            if ($currentPage == 1) {

                //OLD CODE
                //$pagesCount = $this->domX->query('//div[@id="innerLayout"]/div[@id="listContainer"]/section/div[@class="wrapper"]/div[@class="content"]/div[@class="pager rel clr"]/form/fieldset/input[@type="submit"]')->item(0)->attributes->item(0);
                //var_dump($this->domX->query('//div[@id="innerLayout"]/div[@id="listContainer"]/section/div[@class="wrapper"]/div[@class="content"]/div[@class="rel listHandler "]/table/tbody/tr/td/div/p')->item(0));
                $pagesCount = $this->domX->query('//div[@id="innerLayout"]/div[@id="listContainer"]/section/div[@class="wrapper"]/div[@class="content"]/div[@class="rel listHandler "]/table/tbody/tr/td/div/p')->item(0);

                if ($pagesCount != null) {
                    $this->offersCount = intval(ltrim($pagesCount->textContent, '{totalPages:'));
                    $this->offersCount = intval(ltrim($pagesCount->textContent, 'Znaleziono '));

                    $this->pagesCount = intval(floor($this->offersCount/$this->offersPerPage)) + 1;
                } else {
                    $this->pagesCount = 1;
                }

            }

            $allArticlesWithOffers = $this->domX->query('//div[@id="innerLayout"]/div[@id="listContainer"]/section/div[@class="wrapper"]/div[@class="content"]/div/table[@id="offers_table"]/tbody/tr[@class="wrap"]/td/table[@summary="Ogłoszenie"]');

            $temp = array();
            foreach ($allArticlesWithOffers as $article) {
                $offerId = $article->attributes->item(3)->textContent;
                $offerDataId = $article->attributes->item(5)->textContent;
                if (!in_array($offerId, $temp)) {
                    $temp[] = $offerId;
                }
            }
            //var_dump($temp);

            foreach ($temp as $id) {
                //$id = ltrim($id, 'fixed breakword  ad_id');
                $olxOffer = $this->createOfferFromSummary($id);
                $this->offersAsObjectsArray[$id] = $olxOffer;
            }

            $currentPage += 1;
        }
        $this->offersAsIdsArray = array_keys($this->offersAsObjectsArray);

        /*
        echo '<br>';
        var_dump(count($this->offersAsIdsArray));
        echo '<br>';
        var_dump($this->pagesCount);
        */

        return $this->offersAsObjectsArray;
    }

    /**
     * @param \DOMDocument $Dom
     * @return OlxOffer
     */
    public function createOfferFromSummary($id)
    {
        $olxOffer = new OlxOffer();
        $dom = $this->domX->query("//table[@class='". $id ."']")->item(0);
        if($dom !== null) {
            $tempArray = explode(' ', $id);
            $correctId = ltrim($tempArray[3], 'ad_id');
            $olxOffer->setIdOffer($correctId);

            $title = $dom->getElementsByTagName("strong")->item(0);
            if($title !== null) {
                $title = $title->textContent;
                $olxOffer->setTitle($title);
            }

             $price = $dom->getElementsByTagName("strong")->item(1);
            if($price !== null) {
                $price = $price->textContent;
                $price = str_replace(" ", "", $price);
                $price = floatval($price);
                $olxOffer->setPrice($price);
            }

            //$localization = $dom->getElementsByTagName("span")->item(0);
            $localizationDistrict = $this->domX->query("//table[@class='". $id ."']/tbody/tr/td/div/p/small/span")->item(0);
            if($localizationDistrict !== null){
                $localizationDistrict = explode(", " ,$localizationDistrict->textContent);
                $tempLocal = $this->localization;
                if (isset($localizationDistrict[1])) $tempLocal["district"] = trim($localizationDistrict[1], ' ');
                // todo: add district to Localization
                $olxOffer->setLocalization($tempLocal);
            }

            $olxOffer->setOfferType($this->offerType);
            $olxOffer->setCategory($this->category);
        }

        return $olxOffer;
    }
}