<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class PackageValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\Package */

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_integer($value)){
            throw new UnexpectedValueException($value, 'int');
        }

        $packages = (new \ReflectionClass(\App\Entity\Package::class))->getConstants();
        if (!in_array($value, $packages)){
            $this->context->buildViolation($constraint->message)
            ->setParameter('{{ package }}', $value)
            ->addViolation();
        }
    }
}
