<?php

namespace App\Form;

use App\Entity\Annonce;
use App\Entity\Equipement;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('countryname')
            ->add('cityname')
            ->add('streetname')
            ->add('image_path')
            ->add('image_slug')
            ->add('prix')
            ->add('nombre_couchage')
            ->add('nombre_piece')
            ->add('taille')
            ->add('type', EntityType::class, [
                'class' => Type::class,
'choice_label' => 'id',
            ])
            ->add('equipements', EntityType::class, [
                'class' => Equipement::class,
'choice_label' => 'id',
'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
