<?php

namespace MarsupilamiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;


class MarsupilamiType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array('label' => 'form.username',
                'translation_domain' => 'FOSUserBundle',
                'attr' => array(
                    "class" => "form-control",
                ),
            ))
            ->add('age', NumberType::class,array('attr'  => array("class" => "form-control")))
            ->add('famille', TextType::class,array('attr'  => array("class" => "form-control")))
            ->add('email', TextType::class,array('attr'  => array("class" => "form-control")))
            ->add('nourriture', TextType::class,array('attr'  => array("class" => "form-control")))
            ->add('couleur', TextType::class,array('attr'  => array("class" => "form-control")))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array(
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'autocomplete' => 'new-password',
                        "class" => "form-control",
                    ),
                ),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))




            ->add('ajouter',SubmitType::class,array(
        'attr'=>array( "class"=>"btn btn-flat")));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MarsupilamiBundle\Entity\Marsupilami'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'marsupilamibundle_marsupilami';
    }


}
