<?php

namespace Wvs\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NoHTMLValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value !== null && strip_tags($value) !== $value) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }

}