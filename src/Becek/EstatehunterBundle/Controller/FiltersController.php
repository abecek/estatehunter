<?php

namespace Becek\EstatehunterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;


/**
 * @Route("/filters")
 */
class FiltersController extends Controller
{
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

    /**
     * @Route("/getform", name="getForm")
     * @Method({"POST"})
     */
    public function getFormAction(Request $request)
    {
        return new Response('DUPA');
    }

    /**
     * @Route("/new", name="newFilter")
     */
    public function newFilterAction(Request $request)
    {

        $form = $this->createFormBuilder(null, array(
            'attr' => array('class' => 'form'),
        ))->add('title', TextType::class, array(
            'label' => 'Nazwa: ',
            'attr' => array('class' => 'form-control'),
        ))->add('description', TextareaType::class, array(
            'label' => 'Opis: ',
            'required' => false,
            'attr' => array('class' => 'form-control'),
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
        ))->add('searchFrequency', NumberType::class, array(
            'label' => 'Częstotliwość wyszukiwania:',
            'attr' => array('class' => 'form-control'),
        ))->add('submit', SubmitType::class, array(
            'label' => 'Szukaj!',
            'attr' => array('class' => 'btn btn-block btn-primary btn-lg')
        ))->getForm();


        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

        }


        return $this->render('@BecekEstatehunter/Filters/newFilter.html.twig', array(
            'filterForm' => $form->createView(),
            //'data' => $data,
        ));
    }

}
