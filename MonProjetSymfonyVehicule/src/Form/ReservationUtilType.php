<?php

namespace App\Form;

use App\Entity\ReservationUtil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationUtilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ville')
            ->add('dateDepart')
            ->add('dateRetour')
            ->add('utilitaires')
            ->add('utilisateurs')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ReservationUtil::class,
        ]);
    }
}
