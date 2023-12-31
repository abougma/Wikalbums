<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username', TextType::class,[
                    'attr'=>[
                    'data' =>$this->lastUsername,
                    'autofocus' => true,
                ],
            ])
            ->add('_password', PasswordType::class)
        ;
    }
    public function __construct(private ?string $lastUsername=null)
    {

    }
    public function getBlockPrefix(){
        return '';
    }
}
