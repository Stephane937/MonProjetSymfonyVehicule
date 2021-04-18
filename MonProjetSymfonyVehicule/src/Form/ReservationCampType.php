<?php

namespace App\Form;

use App\Entity\ReservationCamp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationCampType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ville')
            ->add('dateDepart')
            ->add('dateRetour')
            ->add('Campingcars')
            ->add('utilisateurs')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ReservationCamp::class,
        ]);
    }
}
