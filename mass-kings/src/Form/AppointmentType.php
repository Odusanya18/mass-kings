<?php

namespace App\Form;

use App\Entity\Appointment;
use App\Entity\Car;
use App\Entity\Package;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('package', ChoiceType::class, [
                'placeholder' => 'Choose a Package Type',
                'choices' => [
                    'Reset Interior Detail' => Package::INTERIOR,
                    'Hand Wash and Wax' => Package::HANDWASH,
                    'Xtreme Exterior Detail' => Package::EXTERIOR,
                    'Ultimate  Int/Ext Detail' => Package::ULTIMATE,
                    'Touch Up Detail' => Package::TOUCHUP,
                    'Additional Services' => Package::ADDITIONAL
                ]
            ])
            ->add('car_size', ChoiceType::class, [
                'placeholder' => 'Choose a Car Size',
                'choices' => [
                    'Small Cars' => Car::SMALL,
                    'Mid Size SUV and Pickups' => Car::MIDSIZE,
                    'Bigger SUV, Vans and Pickups' => Car::BIGSIZE
                ]
            ])
            ->add('location')
            ->add('time')
            ->add('contact_name')
            ->add('contact_phone', TelType::class)
            ->add('contact_email', EmailType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
        ]);
    }
}
