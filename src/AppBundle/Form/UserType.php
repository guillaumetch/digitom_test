<?php

namespace AppBundle\Form;

use AppBundle\Entity\Car;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname')
            ->add('lastname')
            ->add('dateOfBirth',DateType::class,array(
                'widget'=>'single_text'
                ))
            ->add('hasDriverLicense',CheckboxType::class,array('required'=>false))
            ->add('car',EntityType::class,array(
                'class'=>'AppBundle\Entity\Car',
                'choice_label'=>'name',
                'placeholder'=>'Modèle',
                'expanded'=>false,
                'multiple'=>false,
                'required'=>false
            ))
            ->add('color',EntityType::class,array(
                'class'=>'AppBundle\Entity\Color',
                'choice_label'=>'name',
                'placeholder'=>'Couleur',
                'expanded'=>false,
                'multiple'=>false,
                'required'=>false
            ));

        $formModifier = function (FormInterface $form, Car $car = null) {
            $colors = null === $car ? array() : $car->getColors();

            $form->add('color', EntityType::class, array(
                'class' => 'AppBundle:Color',
                'placeholder' => 'Couleurs',
                'choice_label' => 'name',
            ));
        };

        $builder->get('car')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $car = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $car);
            }
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
