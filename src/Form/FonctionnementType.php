<?php

namespace App\Form;

use App\Entity\Fonctionnement;
use App\Entity\Image;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FonctionnementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('q1', CheckboxType::class,['attr'=>['class'=>'form-check-input'], 'required' => false])
            ->add('q2', CheckboxType::class,['attr'=>['class'=>'form-check-input'], 'required' => false])
            ->add('q3', CheckboxType::class,['attr'=>['class'=>'form-check-input'], 'required' => false])
            ->add('q4', CheckboxType::class,['attr'=>['class'=>'form-check-input'], 'required' => false])
            ->add('q5', CheckboxType::class,['attr'=>['class'=>'form-check-input'], 'required' => false])
            ->add('q6', CheckboxType::class,['attr'=>['class'=>'form-check-input'], 'required' => false])
            ->add('q7', CheckboxType::class,['attr'=>['class'=>'form-check-input'], 'required' => false])
            ->add('q8', CheckboxType::class,['attr'=>['class'=>'form-check-input'], 'required' => false])
            ->add('q9', CheckboxType::class,['attr'=>['class'=>'form-check-input'], 'required' => false])
            ->add('q10', CheckboxType::class,['attr'=>['class'=>'form-check-input'], 'required' => false])
            ->add('q11', CheckboxType::class,['attr'=>['class'=>'form-check-input'], 'required' => false])
            ->add('q12', CheckboxType::class,['attr'=>['class'=>'form-check-input'], 'required' => false])
            ->add('q13', CheckboxType::class,['attr'=>['class'=>'form-check-input'], 'required' => false])
            ->add('q14', CheckboxType::class,['attr'=>['class'=>'form-check-input'], 'required' => false])
            ->add('q15', CheckboxType::class,['attr'=>['class'=>'form-check-input'], 'required' => false])
//            ->add('flag')
//            ->add('image', EntityType::class, [
//                'class' => Image::class,
//                'choice_label' => 'id',
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fonctionnement::class,
        ]);
    }
}
