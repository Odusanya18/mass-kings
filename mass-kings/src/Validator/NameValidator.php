<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NameValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\Name */

        if (null === $value || '' === $value) {
            return;
        }

        if (!$constraint instanceof Name) {
            throw new UnexpectedTypeException($constraint, Name::class);
        }

        if (!is_string($value)){
            throw new UnexpectedValueException($value, 'string');
        }

        if (!preg_match('\'^[^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$\'', $value)){
            $this->context->buildViolation($constraint->message)
            ->setParameter('{{ name }}', $value)
            ->addViolation();
        }
    }
}
