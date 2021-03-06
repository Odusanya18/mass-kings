<?php

/*
 * This file is part of the Mass-Kings package.
 *
 * (c) Victor Odusanya <odusanya18@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CarValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        /* @var $constraint \App\Validator\Car */

        if (null === $value || '' === $value) {
            return;
        }

        if (!$constraint instanceof Car) {
            throw new UnexpectedTypeException($constraint, Car::class);
        }

        if (!\is_int($value)) {
            throw new UnexpectedValueException($value, 'int');
        }

        $packages = (new \ReflectionClass(\App\Entity\Car::class))->getConstants();
        if (!\in_array($value, $packages, true)) {
            $this->context->buildViolation($constraint->message)
            ->setParameter('{{ car_size }}', $value)
            ->addViolation();
        }
    }
}
