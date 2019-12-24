<?php

namespace App\Form;

use App\Entity\Medecin;
use App\Entity\Service;
use App\Entity\Specialite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MedecinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule',HiddenType::class)
            ->add('prenom', null, ['attr' => ['minlength' => 2, 'maxlength' => 20]])
            ->add('nom', null, ['attr' => ['minlength' => 2, 'maxlength' => 20]])
            ->add('telephone')
            ->add('service', EntityType::class,[
                'class'=>Service::class,
                'choice_label'=>'libelle'
            ])
            ->add('specialites',EntityType::class,[
                'class'=>Specialite::class,
                'choice_label'=>'name',
                'multiple'=>true,
                'by_reference'=>false
            ])
            ->add('date', DateType::class,['widget'=>'single_text'])
            ->add('save', SubmitType::class, ['label' => 'Enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medecin::class,
        ]);
    }
}
