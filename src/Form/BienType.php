<?php

namespace App\Form;

use App\Entity\Bien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nb_piece',NumberType::class,array('label'=> 'Nombre de pièces  : ', 'attr' => array('class'=>'form-control','placeholder'=>'Nombres de pièces...')))
            ->add('nb_chambre',NumberType::class,array('label'=> 'Nombre de chambres  : ', 'attr' => array('class'=>'form-control','placeholder'=>'Nombres de chambres...')))
            ->add('superficie',NumberType::class,array('label'=> 'Superficie en m2  : ', 'attr' => array('class'=>'form-control','placeholder'=>'Superficie...')))
            ->add('prix',MoneyType::class,array('label'=> 'Prix  : ', 'attr' => array('class'=>'form-control','placeholder'=>'Prix...')))
            ->add('chauffage',TextType::class,array('label'=> 'Chauffage  : ', 'attr' => array('class'=>'form-control','placeholder'=>'Chauffage...')))
            ->add('annee',NumberType::class,array('label'=> 'Année : ', 'attr' => array('class'=>'form-control','placeholder'=>'Année...')))
            ->add('localisation',TextType::class,array('label'=> 'Localisation  : ', 'attr' => array('class'=>'form-control','placeholder'=>'Localisation...')))
            ->add('etat',TextType::class,array('label'=> 'Etat  : ', 'attr' => array('class'=>'form-control','placeholder'=>'Etat...')))
            ->add('id_type', EntityType::class, array('class'=> 'App\Entity\Type','choice_label' => 'libelle'))
                

            ->add('valider',SubmitType::class,array('label'=> 'Valider','attr' => array('class'=>'btn btn-primary btn-block')))        
            ->add('annuler',ResetType::class,array('label'=> 'Quitter','attr' => array('class'=>'btn btn-primary btn-block')))
                
                
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}
