<?php

namespace App\Form;

use App\Entity\Partenaire;
use App\Entity\Permission;
use App\Entity\Structure;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class StructureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'NomGérant@gérant.com'
                ]
            ])

            ->add('install_id', EntityType::class, [
                'class' => Permission::class,
                'expanded' => true,
                'multiple' => true,
                'required'   => false,
                'mapped' => false,
                'choice_label' => function ($install_id) {
                    return $install_id->getStreet();
                }
            ])
            ->add('active', CheckboxType::class, [
                'required'   => false,
                'data' => true,
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'placeholder' => 'Paris'
                ]
            ])
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Garde la patate Paris'
                ]
            ])
            ->add('logoStructure', FileType::class, [
                "data_class" => null,
            ])
            ->add('client_id', EntityType::class, [
                'class' => Partenaire::class,
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Mot de passe provisoire',
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => '******'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Vous devez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins  {{ limit }} caractères.',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => array(
                    'class' => 'buttonSend'
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Structure::class,
        ]);
    }
}
