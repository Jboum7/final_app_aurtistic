<?php

namespace App\Form;

use App\Entity\Setting;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fontsize', ChoiceType::class, [
                'label' => 'Text size',
                'choices' => [
                    'Small' => 0.9,
                    'Normal' => 1,
                    'Large' => 1.2,
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('fontweight', ChoiceType::class, [
                'label' => 'Text weight',
                'choices' => [
                    'Regular' => 400,
                    'Bold' => 600,
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('fontstretch', ChoiceType::class, [
                'label' => 'Text spacing',
                'choices' => [
                    'Normal' => 100,
                    'Wide' => 110,
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('theme', ChoiceType::class, [
                'label' => 'Theme',
                'choices' => [
                    'Light' => 'light',
                    'Dark' => 'dark',
                ],
                'expanded' => true,
                'multiple' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Setting::class,
        ]);
    }
}
