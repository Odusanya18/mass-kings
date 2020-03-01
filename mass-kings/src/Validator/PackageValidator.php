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
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class PackageValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        /* @var $constraint \App\Validator\Package */

        if (null === $value || '' === $value) {
            return;
        }

        if (!$constraint instanceof Package) {
            throw new UnexpectedTypeException($constraint, Package::class);
        }

        if (!\is_int($value)) {
            throw new UnexpectedValueException($value, 'int');
        }

        $packages = (new \ReflectionClass(\App\Entity\Package::class))->getConstants();
        if (!\in_array($value, $packages, true)) {
            $this->context->buildViolation($constraint->message)
            ->setParameter('{{ package }}', $value)
            ->addViolation();
        }
    }
}
