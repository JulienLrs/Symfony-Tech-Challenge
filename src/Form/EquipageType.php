<?php

namespace App\Form;

use App\Entity\Equipage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class EquipageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['placeholder' => 'Ajouter un nom'],
            ])
            ->add('description', TextType::class, [
                'attr' => ['placeholder' => 'Adjectif', 'required' => false],
            ])
            // ->add('imageName')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipage::class,
        ]);
    }
}
