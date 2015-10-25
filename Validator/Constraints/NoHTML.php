<?php

namespace Wvs\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NoHTML extends Constraint
{
    public $message = 'form.default.default.no_html';
}