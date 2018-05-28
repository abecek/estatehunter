<?php

namespace Becek\EstatehunterBundle\Controller;

use Becek\EstatehunterBundle\Entity\Filters\FlatFilter;
use Becek\EstatehunterBundle\Entity\Filters\GroundFilter;
use Becek\EstatehunterBundle\Entity\Filters\HouseFilter;

use Becek\EstatehunterBundle\Form\FlatFilterType;


use Becek\EstatehunterBundle\Form\GroundFilterType;
use Becek\EstatehunterBundle\Form\HouseFilterType;
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
        $data = null;
        $em = $this->getDoctrine()->getManager();

        $flatFilter = new FlatFilter();
        $form1 = $this->createForm(FlatFilterType::class, $flatFilter, array(
            'attr' => array('class' => 'form-row'),
        ));

        $form1->handleRequest($request);
        if($form1->isSubmitted() && $form1->isValid()){
            $flatFilter->setCity(strtolower($flatFilter->getCity()));
            $flatFilter->setRegion(strtolower($flatFilter->getRegion()));
            $flatFilter->setSubregion(strtolower($flatFilter->getSubregion()));

            $flatFilter->setDateCreated(new \DateTime());
            $flatFilter->setIdUser(1);

            $em->persist($flatFilter);
            $em->flush();

            $data = $flatFilter;
        }


        $houseFilter = new HouseFilter();
        $form2 = $this->createForm(HouseFilterType::class, $houseFilter, array(
            'attr' => array('class' => 'form-row'),
        ));

        $form2->handleRequest($request);
        if($form2->isSubmitted() && $form2->isValid()){
            $houseFilter->setCity(strtolower($houseFilter->getCity()));
            $houseFilter->setRegion(strtolower($houseFilter->getRegion()));
            $houseFilter->setSubregion(strtolower($houseFilter->getSubregion()));

            $houseFilter->setDateCreated(new \DateTime());
            $houseFilter->setIdUser(1);

            $em->persist($houseFilter);
            $em->flush();

            $data = $houseFilter;
        }


        $groundFilter = new GroundFilter();
        $form3 = $this->createForm(GroundFilterType::class, $groundFilter, array(
            'attr' => array('class' => 'form-row'),
        ));

        $form3->handleRequest($request);
        if($form3->isSubmitted() && $form3->isValid()){
            $groundFilter->setCity(strtolower($groundFilter->getCity()));
            $groundFilter->setRegion(strtolower($groundFilter->getRegion()));
            $groundFilter->setSubregion(strtolower($groundFilter->getSubregion()));

            $groundFilter->setDateCreated(new \DateTime());
            $groundFilter->setIdUser(1);

            $em->persist($groundFilter);
            $em->flush();

            $data = $groundFilter;
        }



        return $this->render('@BecekEstatehunter/Filters/newFilter.html.twig', array(
            'flatForm' => $form1->createView(),
            'houseForm' => $form2->createView(),
            'groundForm' => $form3->createView(),
            'data' => $data,
        ));
    }

}
