<?php

namespace Defconshop\Form\Validator;

class EmailFieldValidator implements FormValidatorInterface
{
    private $errors = [];

    public function isValid($email): bool
    {
        $this->errors = [];
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $this->errors[] = 'Enter a valid email';
            return false;
        }

        return true;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}