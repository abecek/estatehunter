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
        ))->add('buildingType', ChoiceType::class, array(
            'label' => 'Wybierz kategorię:',
            'attr' => array('class' => 'form-control'),
            'choices' => array(
                'Mieszkania' => 'mieszkania',
                'Domy' => 'domy',
                'Działki i grunty' => 'dzialki-grunty',
                'Lokale użytkowe' => 'lokale-obiekty',
            ),
        ))->add('offerType', ChoiceType::class, array(
            'label' => 'Rodzaj ogłoszenia:',
            'attr' => array('class' => 'form-control'),
            'choices' => array(
                'na sprzedaż' => 'sprzedam',
                'do wynajęcia' => 'do-wynajecia',
                'inne oferty' => 'inne',
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
            $options['buildingType'] = $data['buildingType'];
            $options['offerType'] = $data['offerType'];
            $options['priceFrom'] = $data['priceFrom'];
            $options['priceTo'] = $data['priceTo'];
            $options['priceByAreaFrom'] = $data['priceByAreaFrom'];
            $options['priceByAreaTo'] = $data['priceByAreaTo'];
            $options['areaFrom'] = $data['areaFrom'];
            $options['areaTo'] = $data['areaTo'];
            $options['localization']['region'] = $data['localizationRegion'];
            $options['localization']['subregion'] = $data['localizationSubregion'];
            $options['localization']['town'] = $data['localizationTown'];
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

    public function otodomAction(Request $request)
    {
        $form = $this->createFormBuilder(null, array(
            'attr' => array('class' => 'form'),
        ))->add('buildingType', ChoiceType::class, array(
            'label' => 'Wybierz kategorię:',
            'attr' => array('class' => 'form-control'),
            'choices' => array(
                'Mieszkania' => 'mieszkania',
                'Domy' => 'domy',
                'Działki i grunty' => 'dzialki-grunty',
                'Lokale użytkowe' => 'lokale-obiekty',
            ),
        ))->add('offerType', ChoiceType::class, array(
            'label' => 'Rodzaj ogłoszenia:',
            'attr' => array('class' => 'form-control'),
            'choices' => array(
                'na sprzedaż' => 'sprzedam',
                'do wynajęcia' => 'do-wynajecia',
                'inne oferty' => 'inne',
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
            $options['buildingType'] = $data['buildingType'];
            $options['offerType'] = $data['offerType'];
            $options['priceFrom'] = $data['priceFrom'];
            $options['priceTo'] = $data['priceTo'];
            $options['priceByAreaFrom'] = $data['priceByAreaFrom'];
            $options['priceByAreaTo'] = $data['priceByAreaTo'];
            $options['areaFrom'] = $data['areaFrom'];
            $options['areaTo'] = $data['areaTo'];
            $options['localization']['region'] = $data['localizationRegion'];
            $options['localization']['subregion'] = $data['localizationSubregion'];
            $options['localization']['town'] = $data['localizationTown'];
            $options['addedBy'] = $data['addedBy'];

            $otodomGenerator = new OtodomGenerator();
            $offers = $otodomGenerator->loadOffersFromPages($options);

        }

        return $this->render("@BecekEstatehunter/Default/otodom.html.twig", array(
            'searchForm' => $form->createView(),
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
