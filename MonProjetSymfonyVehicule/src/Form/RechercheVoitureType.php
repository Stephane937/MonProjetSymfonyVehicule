<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class RechercheVoitureType extends AbstractType
{
    const PRIX = [20, 30, 40, 50, 60, 70, 80];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('moteur', ChoiceType::class, [
                'choices' => [
                    'Diesel' => 'Diesel',
                    'Essence' => 'Essence'
                ]
            ])
            ->add('places', ChoiceType::class, [
                'choices' => [
                    '2' => '2',
                    '4' => '4',
                    '5' => '5',
                    '7' => '7'
                ]
            ])
            ->add('prixMinimum', ChoiceType::class, [
                'label' => 'Prix minimum',
                'choices' => array_combine(self::PRIX, self::PRIX)
            ])
            ->add('prixMaximum', ChoiceType::class, [
                'label' => 'Prix maximum',
                'choices' => array_combine(self::PRIX, self::PRIX)
            ])
            ->add('recherche', SubmitType::class);
    }
}