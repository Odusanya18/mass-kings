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
class Time extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'The time "{{ time }}" selected has been booked by another customer.';
}
