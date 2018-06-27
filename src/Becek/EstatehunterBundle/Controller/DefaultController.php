<?php

namespace Becek\EstatehunterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Becek\EstatehunterBundle\Utils\Scrapers\DomGratkaScraper;
use Becek\EstatehunterBundle\Utils\Scrapers\OtodomScraper;
use Becek\EstatehunterBundle\Utils\Scrapers\OlxScraper;

use Becek\EstatehunterBundle\Utils\PolishCharsExtractor;

class DefaultController extends Controller
{

    public function indexAction(){

        return $this->render("@BecekEstatehunter/Default/index.html.twig", array(
        ));
    }

    // todo: Create FormModel and function to process request
    public function gratkaAction(Request $request)
    {
        $form = $this->createFormBuilder(null, array(
            'attr' => array('class' => 'form'),
        ))->add('category', ChoiceType::class, array(
            'label' => 'Wybierz kategorię:',
            'attr' => array('class' => 'form-control'),
            'choices' => array(
                'Mieszkania' => 'mieszkania',
                'Domy' => 'domy',
                'Działki i grunty' => 'dzialki-grunty',
            //    'Lokale użytkowe' => 'lokale-obiekty',
            ),
        ))->add('offerType', ChoiceType::class, array(
            'label' => 'Rodzaj ogłoszenia:',
            'attr' => array('class' => 'form-control'),
            'choices' => array(
                'na sprzedaż' => 'sprzedaz',
                'do wynajęcia' => 'wynajem',
                //'zamiana' => 'zamiana',,
                //'pozostałe' => 'pozostale',
            //    'inne oferty' => 'inne',
            ),
        ))->add('priceFrom', MoneyType::class, array(
            'label' => 'Cena od:',
            'currency' => '',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('priceTo', MoneyType::class, array(
            'label' => 'Cena do:',
            'currency' => '',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('priceByAreaFrom', MoneyType::class, array(
            'label' => 'Cena za m^2 od:',
            'currency' => '',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('priceByAreaTo', MoneyType::class, array(
            'label' => 'Cena za m^2 do:',
            'currency' => '',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('areaFrom', TextType::class, array(
            'label' => 'Powierzchnia od:',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('areaTo', TextType::class, array(
            'label' => 'Powierzchnia do:',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('localizationRegion', TextType::class, array(
            'label' => 'Lokalizacja(województwo):',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('localizationSubregion', TextType::class, array(
            'label' => 'Lokalizacja(powiat):',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('localizationTown', TextType::class, array(
            'label' => 'Lokalizacja(miejscowość):',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('addedBy', ChoiceType::class, array(
            'label' => 'Dodane przez:',
            'attr' => array('class' => 'form-control'),
            'choices' => array(
                'Wszystkich' => null,
                'Biura nieruchomości' => 'estate agencies',
                'Gazety' => 'newspapers',
                'Osoby prywatne' => 'private persons',
                'Inne' => 'others',
            ),
        ))->add('submit', SubmitType::class, array(
            'label' => 'Szukaj!',
            'attr' => array('class' => 'btn btn-block btn-primary btn-lg')
        ))->getForm();

        $data = null;
        $html = null;
        $offers = array();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $options = array();
            $options['category'] = $data['category'];
            $options['offerType'] = $data['offerType'];
            $options['priceFrom'] = $data['priceFrom'];
            $options['priceTo'] = $data['priceTo'];
            $options['priceByAreaFrom'] = $data['priceByAreaFrom'];
            $options['priceByAreaTo'] = $data['priceByAreaTo'];
            $options['areaFrom'] = $data['areaFrom'];
            $options['areaTo'] = $data['areaTo'];
            $options['localization']['subregion'] = PolishCharsExtractor::changePolishChars(preg_replace('<<(.*?)>>', '', $data['localizationSubregion']));
            $options['localization']['region'] = PolishCharsExtractor::changePolishChars(preg_replace('<<(.*?)>>', '', $data['localizationRegion']));
            $options['localization']['town'] = PolishCharsExtractor::changePolishChars(preg_replace('<<(.*?)>>', '', $data['localizationTown']));
            $options['addedBy'] = $data['addedBy'];

            $domGratkaGenerator = new DomGratkaScraper();
            $offers = $domGratkaGenerator->loadOffersFromPages($options);
        }

        return $this->render("@BecekEstatehunter/Default/gratka.html.twig", array(
            'searchForm' => $form->createView(),
            'data' => $data,
            'html' => $offers,
        ));
    }

    // todo: Create FormModel and function to process request
    public function otodomAction(Request $request, $suggestText = null)
    {
        $form = $this->createFormBuilder(null, array(
            'attr' => array('class' => 'form'),
        ))->add('localizationTown', TextType::class, array(
            'label' => 'Lokalizacja(miejscowość):',
            'required'   => false,
            'attr' => array('class' => 'form-control'),
        ))->add('localizationRegion', TextType::class, array(
            'label' => 'Lokalizacja(województwo):',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('localizationSubregion', TextType::class, array(
            'label' => 'Lokalizacja(powiat):',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('category', ChoiceType::class, array(
            'label' => 'Wybierz kategorię:',
            'attr' => array('class' => 'form-control'),
            'choices' => array(
                'Mieszkania' => 'mieszkanie',
                'Domy' => 'dom',
             //   'Działki i grunty' => 'dzialka',
             //   'Lokale użytkowe' => 'lokal',
            ),
        ))->add('offerType', ChoiceType::class, array(
            'label' => 'Rodzaj ogłoszenia:',
            'attr' => array('class' => 'form-control'),
            'choices' => array(
                'na sprzedaż' => 'sprzedaz',
                'do wynajęcia' => 'wynajem',
            ),
        ))->add('priceFrom', MoneyType::class, array(
            'label' => 'Cena od:',
            'currency' => '',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('priceTo', MoneyType::class, array(
            'label' => 'Cena do:',
            'currency' => '',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('priceByAreaFrom', MoneyType::class, array(
            'label' => 'Cena za m^2 od:',
            'currency' => '',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('priceByAreaTo', MoneyType::class, array(
            'label' => 'Cena za m^2 do:',
            'currency' => '',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('areaFrom', TextType::class, array(
            'label' => 'Powierzchnia od:',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('areaTo', TextType::class, array(
            'label' => 'Powierzchnia do:',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('addedBy', ChoiceType::class, array(
            'label' => 'Dodane przez:',
            'attr' => array('class' => 'form-control'),
            'choices' => array(
                'Wszystkich' => null,
                'Osoby prywatne' => 'private',
        ),
        ))->add('submit', SubmitType::class, array(
            'label' => 'Szukaj!',
            'attr' => array('class' => 'btn btn-block btn-primary btn-lg')
        ))->getForm();


        $data = null;
        $html = null;
        $offers = array();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $options = array();
            $options['category'] = $data['category'];
            $options['offerType'] = $data['offerType'];
            $options['priceFrom'] = $data['priceFrom'];
            $options['priceTo'] = $data['priceTo'];
            $options['priceByAreaFrom'] = $data['priceByAreaFrom'];
            $options['priceByAreaTo'] = $data['priceByAreaTo'];
            $options['areaFrom'] = $data['areaFrom'];
            $options['areaTo'] = $data['areaTo'];
            $options['localization']['town'] = PolishCharsExtractor::changePolishChars(preg_replace('<<(.*?)>>', '', $data['localizationTown']));
            $options['localization']['subregion'] = PolishCharsExtractor::changePolishChars(preg_replace('<<(.*?)>>', '', $data['localizationSubregion']));
            $options['localization']['region'] = PolishCharsExtractor::changePolishChars(preg_replace('<<(.*?)>>', '', $data['localizationRegion']));
            $options['addedBy'] = $data['addedBy'];

            /*
            //Getting CityId, RegionId, SubRegionId and level from otodom.pl
            $responseFromOtodom = json_decode($this->otodomRequestAction($options));
            $wantedLocalizationAsArray = array_values($options['localization']);

            if(!empty($responseFromOtodom)){
                foreach($responseFromOtodom as $city){
                    $tempArray = explode(', ', strtolower($city->text));
                    $tempArray[0] = $this->changingPolishChars(preg_replace('<<(.*?)>>', '', $tempArray[0]));
                    $tempArray[1] = $this->changingPolishChars(preg_replace('<<(.*?)>>', '', $tempArray[1]));

                    if(isset($tempArray[2])) {
                        $tempArray[2] = $this->changingPolishChars(preg_replace('<<(.*?)>>', '', $tempArray[2]));
                    }
                    else{
                        $temp = $tempArray[1];
                        $tempArray[1] = null;
                        $tempArray[2] = $temp;
                    }

                    if($wantedLocalizationAsArray == $tempArray){
                        $options['cityId'] = $city->city_id;
                        $options['subregionId'] = $city->subregion_id;
                        $options['regionId'] = $city->region_id;
                        $options['level'] = strtolower($city->level);
                    }
                }
            }
            */

            $otodomGenerator = new OtodomScraper();
            $offers = $otodomGenerator->loadOffersFromPages($options);
        }

        return $this->render("@BecekEstatehunter/Default/otodom.html.twig", array(
            'searchForm' => $form->createView(),
            'suggestText' => $suggestText,
            'data' => $data,
            'html' => $offers,
        ));
    }

    private function otodomRequest($localization) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://www.otodom.pl/ajax/geo6/autosuggest/?data=" . $localization . "^&levels^%^5B^%^5D=REGION^&levels^%^5B^%^5D=SUBREGION^&levels^%^5B^%^5D=CITY^&levels^%^5B^%^5D=DISTRICT^&levels^%^5B^%^5D=STREET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $headers = array();
        //$headers[] = "Cookie: __gfp_64b=dWbRmj0wp44nADkYHJBOtezPu3d2iKXxZeVkTD..Dzr.m7; optimizelyEndUserId=oeu1508111659215r0.8812146601196635; _cmuid=7b53e6e3-4622-4f61-8203-2e2b382716a3; __gads=ID=9e9d7c034d5f80c0:T=1508111678:S=ALNI_MY76I4IvVZ9GzMVzqeaf8kVtpgS4Q; cookieBarSeen=true; optimizelySegments=^%^7B^%^222105660096^%^22^%^3A^%^22gc^%^22^%^2C^%^222106010045^%^22^%^3A^%^22false^%^22^%^2C^%^222110010055^%^22^%^3A^%^22referral^%^22^%^2C^%^222110550062^%^22^%^3A^%^22none^%^22^%^7D; _ga=GA1.2.1945782446.1508111660; fonce_current_user=1; optimizelyBuckets=^%^7B^%^7D; mobileappsbadge=1; PHPSESSID=a2lefn11b308le2petap833qk4; mobile_default=desktop; ldTd=true; fonce_current_day=1,2018-03-01; _gid=GA1.2.805843924.1519916267; newrelicInited=0; onap=15f2275b080x34aec21b-22-161e211b10ex15547513-4-1519918077; mp_5da98ecd30a0b9103c5c42f2d2c5575b_mixpanel=^%^7B^%^22distinct_id^%^22^%^3A^%^20^%^2215f2275b1e86c4-0e80b7e72ec091-3b3e5906-140000-15f2275b1e95c3^%^22^%^2C^%^22^%^24initial_referrer^%^22^%^3A^%^20^%^22^%^24direct^%^22^%^2C^%^22^%^24initial_referring_domain^%^22^%^3A^%^20^%^22^%^24direct^%^22^%^2C^%^22^%^24search_engine^%^22^%^3A^%^20^%^22google^%^22^%^7D";
        $headers[] = "Accept-Encoding: gzip, deflate, br";
        $headers[] = "Accept-Language: pl-PL,pl;q=0.9,en-US;q=0.8,en;q=0.7";
        $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36";
        $headers[] = "Accept: application/json, text/javascript, */*; q=0.01";
        $headers[] = "Referer: https://www.otodom.pl/";
        $headers[] = "X-Requested-With: XMLHttpRequest";
        $headers[] = "Connection: keep-alive";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch) . PHP_EOL;
        }
        curl_close ($ch);

        return new JsonResponse(strip_tags($result));
    }



    public function localizationAction(Request $request, $target = "otodom")
    {
        //$localization = $request->get('localization');
        $localization = $request->get('q');

        if ($localization != 'null') {

            return $this->otodomRequest($localization);
        }
        else {
            return new Response('DUPA');
        }

    }

    // todo: Create FormModel and function to process request
    public function olxAction(Request $request, $suggestText = null)
    {
        $data = null;
        $form = $this->createFormBuilder(null, array(
            'attr' => array('class' => 'form')
        ))->add('localizationTown', TextType::class, array(
            'label' => 'Lokalizacja(miejscowość):',
            'required'   => false,
            'attr' => array('class' => 'form-control'),
        ))->add('localizationRegion', TextType::class, array(
            'label' => 'Lokalizacja(województwo):',
            'required' => false,
            'attr' => array('class' => 'form-control'),
        ))->add('localizationSubregion', TextType::class, array(
            'label' => 'Lokalizacja(powiat):',
            'required' => false,
            'attr' => array('class' => 'form-control'),
        ))->add('category', ChoiceType::class, array(
            'label' => 'Wybierz kategorię:',
            'attr' => array('class' => 'form-control'),
            'choices' => array(
                'Mieszkania' => 'mieszkania',
                'Domy' => 'domy',
                //   'Działki i grunty' => 'dzialki',
                //   'Biura i Lokale' => 'biura-lokale',
            ),
        ))->add('offerType', ChoiceType::class, array(
            'label' => 'Rodzaj ogłoszenia:',
            'attr' => array('class' => 'form-control'),
            'choices' => array(
                'Sprzedaż' => 'sprzedaz',
                'Wynajem' => 'wynajem',
                //'Zymiana' => 'zamiana',
            ),
        ))->add('priceFrom', MoneyType::class, array(
            'label' => 'Cena od:',
            'currency' => '',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('priceTo', MoneyType::class, array(
            'label' => 'Cena do:',
            'currency' => '',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('areaFrom', TextType::class, array(
            'label' => 'Powierzchnia od:',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('areaTo', TextType::class, array(
            'label' => 'Powierzchnia do:',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('addedBy', ChoiceType::class, array(
            'label' => 'Dodane przez:',
            'attr' => array('class' => 'form-control'),
            'choices' => array(
                'Wszystkich' => null,
                'Osoby prywatne' => 'private',
                'Biura/Deweloperzy' => 'business'
            ),
        ))->add('submit', SubmitType::class, array(
            'label' => 'Szukaj!',
            'attr' => array('class' => 'btn btn-block btn-primary btn-lg')
        ))->getForm();

        $data = null;
        $html = null;
        $offers = array();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $options = array();
            $options['category'] = $data['category'];
            $options['offerType'] = $data['offerType'];
            $options['priceFrom'] = $data['priceFrom'];
            $options['priceTo'] = $data['priceTo'];
            $options['areaFrom'] = $data['areaFrom'];
            $options['areaTo'] = $data['areaTo'];
            $options['localization']['subregion'] = PolishCharsExtractor::changePolishChars(preg_replace('<<(.*?)>>', '', $data['localizationSubregion']));
            $options['localization']['region'] = PolishCharsExtractor::changePolishChars(preg_replace('<<(.*?)>>', '', $data['localizationRegion']));
            $options['localization']['town'] = PolishCharsExtractor::changePolishChars(preg_replace('<<(.*?)>>', '', $data['localizationTown']));
            $options['addedBy'] = $data['addedBy'];

            $olxGenerator = new OlxScraper();
            $offers = $olxGenerator->loadOffersFromPages($options);
        }

        return $this->render("@BecekEstatehunter/Default/olx.html.twig", array(
            'searchForm' => $form->createView(),
            'suggestText' => $suggestText,
            'data' => $data,
            'html' => $offers,
        ));
    }


    public function getOutputAction(Request $request)
    {
        return $this->render("@BecekEstatehunter/Default/index.html.twig", array(

        ));
    }
}
