<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 23.05.2018
 * Time: 19:17
 */

namespace Becek\EstatehunterBundle\Form;


use Becek\EstatehunterBundle\Entity\Filters\FlatFilter;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class FlatFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, array(
            'label' => 'Podaj nazwę: ',
            'required'   => false,
            'attr' => array('class' => 'form-control'),
        ))->add('city', TextType::class, array(
            'label' => 'Lokalizacja(miejscowość): ',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('region', TextType::class, array(
            'label' => 'Lokalizacja(województwo): ',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('subregion', TextType::class, array(
            'label' => 'Lokalizacja(powiat): ',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('priceFrom', MoneyType::class, array(
            'label' => 'Cena od: ',
            'currency' => '',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('priceTo', MoneyType::class, array(
            'label' => 'Cena do: ',
            'currency' => '',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('priceAreaFrom', MoneyType::class, array(
            'label' => 'Cena za m^2 od: ',
            'currency' => '',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('priceAreaTo', MoneyType::class, array(
            'label' => 'Cena za m^2 do: ',
            'currency' => '',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('areaFrom', TextType::class, array(
            'label' => 'Powierzchnia od: ',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('areaTo', TextType::class, array(
            'label' => 'Powierzchnia do: ',
            'required'   => false,
            'attr' => array('class' => 'form-control')
        ))->add('floorsCountFrom', RangeType::class, array(
            'label' => 'Piętra całego budynku od: ',
            'required'   => false,
            'attr' => array(
                'class' => 'form-control',
                'min' => 0,
                'max' => 50,
            ),
        ))->add('floorsCountTo', RangeType::class, array(
            'label' => 'Piętra do: ',
            'required'   => false,
            'attr' => array(
                'class' => 'form-control',
                'min' => 0,
                'max' => 50,
            ),
        ))->add('roomsCount', RangeType::class, array(
            'label' => 'Liczba pokoi: ',
            'required'   => false,
            'attr' => array(
                'class' => 'form-control',
                'min' => 1,
                'max' => 14,
            ),
        ))->add('constructionYearFrom', RangeType::class, array(
            'label' => 'Rok budowy budynku od: ',
            'required'   => false,
            'attr' => array(
                'class' => 'form-control',
                'min' => 1900,
                'max' => 2018,
            ),
        ))->add('constructionYearTo', RangeType::class, array(
            'label' => 'Rok budowy budynku do: ',
            'required'   => false,
            'attr' => array(
                'class' => 'form-control',
                'min' => 1900,
                'max' => 2018,
            ),
        ))->add('addedBy', ChoiceType::class, array(
            'label' => 'Dodane przez: ',
            'attr' => array('class' => 'form-control'),
            'choices' => array(
                'Wszystkich' => 0,
                'Biura nieruchomości' => 1,
                'Gazety' => 2,
                'Osoby prywatne' => 3,
                'Inne' => 4,
            ),
        ))->add('marketType', ChoiceType::class, array(
            'label' => 'Rynek: ',
            'attr' => array('class' => 'form-control'),
            'choices' => array(
                'Wszystkie' => 0,
                'Pierwotny' => 1,
                'Wtórny' => 2,
            ),
        ))->add('buildingType', ChoiceType::class, array(
            'label' => 'Typ budynku: ',
            'attr' => array('class' => 'form-control'),
            'choices' => array(
                'Wszystkie' => 0,
                'Blok' => 1,
                'Kamienica' => 2,
            ),
        ))->add('description', TextareaType::class, array(
            'label' => 'Podaj opis: ',
            'required'   => false,
            'attr' => array('class' => 'form-control'),
        ))->add('submit', SubmitType::class, array(
            'label' => 'Dodaj filtr mieszkań!',
            'attr' => array('class' => 'btn btn-block btn-primary btn-lg')
        ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => FlatFilter::class,
        ));
    }

}