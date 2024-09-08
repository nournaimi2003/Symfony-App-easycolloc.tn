<?php

namespace App\Form;

use App\Entity\Offre;
use App\Entity\Region;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class OffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_offre')
            ->add('description',TextareaType::class)
            ->add('date_creation')
            ->add('surface')
            ->add('prix')
            ->add('animaux')
            ->add('femeur')
            ->add('meuble')
            ->add('numeroTel')
            ->add('image',FileType::class,['label'=> 'Image'])
            ->add('coloc_occup')
            ->add('region',EntityType::class,['class' => Region::class,
            'choice_label' => 'libelle',
            'label' => 'Region'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offre::class,
        ]);
    }
}
