<?php

namespace App\Form;

use App\Entity\Permission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PermissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('send_newsletter', CheckboxType::class, [
                'required' => false,
                'data' => true,
            ])
            ->add('sell_drink', CheckboxType::class, [
                'required' => false,
                'data' => true,
            ])
            ->add('payment_stats', CheckboxType::class, [
                'required' => false,
                'data' => false,
            ])
            ->add('add_members', CheckboxType::class, [
                'required' => false,
                'data' => true,
            ])
            ->add('recrut_employee', CheckboxType::class, [
                'required' => false,
                'data' => false,
            ])
            ->add('activated_website', CheckboxType::class, [
                'required' => false,
                'data' => true,
            ])
            ->add('place_search', CheckboxType::class, [
                'required' => false,
                'data' => false,
            ])
            ->add('restaurant_site', CheckboxType::class, [
                'required' => false,
                'data' => false,

            ])
            ->add('renovation', CheckboxType::class, [
                'required' => false,
                'data' => false,

            ])
            ->add('available_coach', CheckboxType::class, [
                'required' => false,
                'data' => true,
            ])
            ->add('street', TextType::class)
            ->add('branch_id')
            ->add('isActive', CheckboxType::class, [
                'required' => false,
                'data' => true,
            ])
            ->add('submit', SubmitType::class, [
                'attr' => array(
                    'class' => 'buttonSend',
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Permission::class,
        ]);
    }
}
