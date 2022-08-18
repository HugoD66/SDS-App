<?php

namespace App\Form;

use App\Entity\Permission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PermissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('send_newsletter')
            ->add('sell_drink')
            ->add('payment_stats')
            ->add('add_members')
            ->add('recrut_employee')
            ->add('activated_website')
            ->add('place_search')
            ->add('restaurant_site')
            ->add('renovation')
            ->add('available_coach')
            ->add('street')
            ->add('branch_id')
            ->add('isActive')
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
