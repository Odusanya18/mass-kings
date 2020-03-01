<?php

namespace App\Validator;

use App\Repository\AppointmentRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TimeValidator extends ConstraintValidator
{
    private $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    public function validate($value, Constraint $constraint) :void
    {
        /* @var $constraint \App\Validator\Time */

        if (null === $value || '' === $value) {
            return;
        }

        if (!$constraint instanceof Time) {
            throw new UnexpectedTypeException($constraint, Time::class);
        }

        if (!$value instanceof \DateTimeImmutable){
            throw new UnexpectedValueException($value, 'datetimetz_immutable');
        }
        
        if ($value < new \DateTimeImmutable('+1 hour')){
            $this->context->buildViolation('Appointment time {{ time }} must at least an hour ahead.')
            ->setParameter('{{ time }}', $value->format(\DateTimeInterface::RSS))
            ->addViolation();

            return;
        }

        if ($this->appointmentRepository->hasAppointmentAt($value)){
            $this->context->buildViolation($constraint->message)
            ->setParameter('{{ time }}', $value->format(\DateTimeInterface::RSS))
            ->addViolation();
        }
        
    }
}
