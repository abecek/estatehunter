<?php

namespace Becek\EstatehunterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Validator\Constraints\File;

class DefaultController extends Controller
{


    public function indexAction(Request $request)
    {
        $form = $this->createFormBuilder(null, array(
            'attr' => array('class' => 'form'),
        ))
            ->add('priceFrom', MoneyType::class, array(
            'label' => 'Cena od:',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('priceTo', MoneyType::class, array(
            'label' => 'Cena do:',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('priceByAreaFrom', MoneyType::class, array(
            'label' => 'Cena za M^2 od:',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('priceByAreaTo', MoneyType::class, array(
            'label' => 'Cena za M^2 do:',
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
        ))->add('localization', TextType::class, array(
            'label' => 'Lokalizacja:',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('submit', SubmitType::class, array(
            'label' => 'Szukaj!',
            'attr' => array('class' => 'btn btn-block btn-primary btn-lg')
        ))->getForm();


        $data = null;
        $html = null;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            /*
            $curlHandle = curl_init();

            curl_setopt($curlHandle, CURLOPT_URL,
                'http://dom.gratka.pl/mieszkania-sprzedam/lista/,,155000,250000,Łódź,2000,4000,39,75,on,co,cd,lok,cmo,cmd,mo,md,zi.html'
            );

            curl_setopt($curlHandle, CURLOPT_URL,
                'https://www.otodom.pl/sprzedaz/mieszkanie/lodz/?search[filter_float_price:from]=150000&search[filter_float_price:to]=300000&search[filter_float_price_per_m:from]=2500&search[filter_float_price_per_m:to]=3500&search[filter_float_m:from]=40&search[filter_float_m:to]=70&search[description]=1&search[private_business]=private&search[dist]=0&search[subregion_id]=127&search[city_id]=1004'
            );

            curl_setopt($curlHandle, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36');
            curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, true);
            //curl_setopt($curlHandle, CURLOPT_COOKIEJAR, 'cookie.txt');
            $html = curl_exec($curlHandle);
            curl_close($curlHandle);
            */

            /*
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://dom.gratka.pl/mieszkania-sprzedam/lista/,,155000,250000,Łódź,2000,4000,39,75,on,co,cd,lok,cmo,cmd,mo,md,zi.html");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            if(curl_errno($ch)){
                echo 'Error: ' . curl_error($ch);
            }
            curl_close($ch);
            var_dump($result);
            exit;
            */


            $param1 = null;
            $param2 = null;
            exec('/mingw64/bin/curl http://dom.gratka.pl/mieszkania-sprzedam/lista/,,155000,250000,Łódź,2000,4000,39,75,on,co,cd,lok,cmo,cmd,mo,md,zi.html -o "C:\xampp\htdocs\estatehunter\outTest.txt"', $param1, $param2);
            var_dump($param1);
            var_dump($param2);
            exit;

        }

        return $this->render("@BecekEstatehunter/Default/index.html.twig", array(
            'searchForm' => $form->createView(),
            'data' => $data,
            'html' => $html,
        ));
    }

    public function getOutputAction(Request $request)
    {
        $fs = new Filesystem();
        $fs->dumpFile('file.txt', $request);
        var_dump($request);

        exit;
        return $this->render("@BecekEstatehunter/Default/index.html.twig", array(

        ));
    }
}
