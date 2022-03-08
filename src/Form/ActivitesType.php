<?php

namespace App\Form;

use App\Entity\Activites;
use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\Selectable;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Select;
use SebastianBergmann\CodeCoverage\Driver\Selector;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivitesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description',TextareaType::class)
            ->add('image',FileType::class,[ 
                'data_class'=>null
            ])
            ->add('adresse')
            ->add('categories', EntityType::class,[
                'class' => \App\Entity\Categorie::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'nom',
            ])
            ->add('public')
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Activites::class,
        ]);
    }
}
