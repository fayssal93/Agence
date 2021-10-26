<?php

namespace App\Form;

use App\Entity\Recherche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('maxPrice', IntegerType::class, [
                'required'=>false, 
                'label' => false, 
                'attr' => [
                    'placeholder' => 'Prix Maximal'
                ]
            ])
            ->add('minSurface', IntegerType::class, [
                'required' => false, 
                'label' => false, 
                'attr' => [
                    'placeholder' => 'Surface Minimum'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recherche::class,
            'method' => 'get', 
            'csrf_protection' => false 
        ]);
    }

    public function getBlockPrefix(){
        return '';
    }
}
