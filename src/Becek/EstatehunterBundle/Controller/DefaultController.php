<?php

namespace Becek\EstatehunterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Becek\EstatehunterBundle\Utils\Generators\DomGratkaGenerator;
use Becek\EstatehunterBundle\Utils\Generators\OtodomGenerator;

class DefaultController extends Controller
{

    public function indexAction(){

        return $this->render("@BecekEstatehunter/Default/index.html.twig", array(
        ));
    }

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
            //    'Działki i grunty' => 'dzialki-grunty',
            //    'Lokale użytkowe' => 'lokale-obiekty',
            ),
        ))->add('offerType', ChoiceType::class, array(
            'label' => 'Rodzaj ogłoszenia:',
            'attr' => array('class' => 'form-control'),
            'choices' => array(
                'na sprzedaż' => 'sprzedam',
                'do wynajęcia' => 'do-wynajecia',
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
        if($form->isSubmitted() && $form->isValid()){
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
            $options['localization']['subregion'] = $this->changingPolishChars(preg_replace('<<(.*?)>>', '', $data['localizationSubregion']));
            $options['localization']['region'] = $this->changingPolishChars(preg_replace('<<(.*?)>>', '', $data['localizationRegion']));
            $options['localization']['town'] = $this->changingPolishChars(preg_replace('<<(.*?)>>', '', $data['localizationTown']));
            $options['addedBy'] = $data['addedBy'];

            $domGratkaGenerator = new DomGratkaGenerator();
            $offers = $domGratkaGenerator->loadOffersFromPages($options);

        }

        return $this->render("@BecekEstatehunter/Default/gratka.html.twig", array(
            'searchForm' => $form->createView(),
            'data' => $data,
            'html' => $offers,
        ));
    }

    private function otodomRequestAction($options)
    {
        $result = null;
        if($options['localization']['town']  != ''){
            // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://www.otodom.pl/ajax/geo6/autosuggest/?data=". $options['localization']['town'] ."^&levels^[^]=REGION^&levels^[^]=SUBREGION^&levels^[^]=CITY^&levels^[^]=DISTRICT^&levels^[^]=STREET");
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
            $headers[] = "Connection: keep-alive";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close ($ch);

        }
        return $result;
    }

    private function changingPolishChars($string)
    {
        $a = array( 'Ę', 'Ó', 'Ą', 'Ś', 'Ł', 'Ż', 'Ź', 'Ć', 'Ń', 'ę', 'ó', 'ą',
            'ś', 'ł', 'ż', 'ź', 'ć', 'ń' );
        $b = array( 'E', 'O', 'A', 'S', 'L', 'Z', 'Z', 'C', 'N', 'e', 'o', 'a',
            's', 'l', 'z', 'z', 'c', 'n' );

        $string = str_replace( $a, $b, $string );
        $string = preg_replace( '#[^a-z0-9]#is', ' ', $string );
        $string = trim( $string );
        $string = preg_replace( '#\s{2,}#', ' ', $string );
        $string = str_replace( ' ', '-', $string );
        $string = strtolower($string);

        return $string;
    }

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
                'Osoby prywatne' => 'private persons',
        ),
        ))->add('submit', SubmitType::class, array(
            'label' => 'Szukaj!',
            'attr' => array('class' => 'btn btn-block btn-primary btn-lg')
        ))->getForm();


        $data = null;
        $html = null;
        $offers = array();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
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
            $options['localization']['town'] = $this->changingPolishChars(preg_replace('<<(.*?)>>', '', $data['localizationTown']));
            $options['localization']['subregion'] = $this->changingPolishChars(preg_replace('<<(.*?)>>', '', $data['localizationSubregion']));
            $options['localization']['region'] = $this->changingPolishChars(preg_replace('<<(.*?)>>', '', $data['localizationRegion']));
            $options['addedBy'] = $data['addedBy'];

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

            $otodomGenerator = new OtodomGenerator();
            $offers = $otodomGenerator->loadOffersFromPages($options);
        }

        return $this->render("@BecekEstatehunter/Default/otodom.html.twig", array(
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
