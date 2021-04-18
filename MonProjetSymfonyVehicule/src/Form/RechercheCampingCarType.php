<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class RechercheCampingCarType extends AbstractType
{
    const PRIX = [20, 30, 40, 50, 60, 70, 80, 90, 100, 110];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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