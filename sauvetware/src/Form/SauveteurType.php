<?php

namespace App\Form;

use App\Entity\Sauveteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SauveteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('patronyme')
            ->add('family')
            ->add('prenom')
            ->add('birth')
            ->add('death')
            ->add('maried')
            ->add('children')
            ->add('child_of')
            ->add('infos')
            ->add('code')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sauveteur::class,
        ]);
    }
}
