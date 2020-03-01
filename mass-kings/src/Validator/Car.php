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

/**
 * @Annotation
 */
class Car extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'The Car Size "{{ car_size }}" selected is not valid.';
}
