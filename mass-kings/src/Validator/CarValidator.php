<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CarValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\Car */

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_integer($value)){
            throw new UnexpectedValueException($value, 'int');
        }

        $packages = (new \ReflectionClass(\App\Entity\Car::class))->getConstants();
        if (!in_array($value, $packages)){
            $this->context->buildViolation($constraint->message)
            ->setParameter('{{ car_size }}', $value)
            ->addViolation();
        }
    }
}
