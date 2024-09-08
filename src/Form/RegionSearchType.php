<?php

namespace App\Form;

use App\Entity\Region;
use App\Entity\RegionSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegionSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('region',EntityType::class,['class' => Region::class,
        'choice_label' => 'libelle',
        'label' => 'Region'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RegionSearch::class,
        ]);
    }
}
