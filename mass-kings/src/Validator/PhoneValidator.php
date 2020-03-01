<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PhoneValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\Phone */

        if (null === $value || '' === $value) {
            return;
        }

        if (!$constraint instanceof Phone) {
            throw new UnexpectedTypeException($constraint, Phone::class);
        }

        if (!is_string($value)){
            throw new UnexpectedValueException($value, 'string');
        }

        if (!preg_match('/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/gm', $value)){
            $this->context->buildViolation($constraint->message)
            ->setParameter('{{ phone }}', $value)
            ->addViolation();
        }
    }
}
