<?php

namespace App\Form;

use App\Entity\Facility;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FacilityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category')
            ->add('name')
            ->add('longitude')
            ->add('latitude')
            ->add('img')
            ->add('description')
            ->add('festival')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Facility::class,
        ]);
    }
}
