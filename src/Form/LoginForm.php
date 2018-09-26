<?php

namespace Defconshop\Form;

use Defconshop\Form\Validator\EmailFieldValidator;

class LoginForm
{
    private $emailValidator;
    private $errors;

    public function __construct(EmailFieldValidator $emailFieldValidator)
    {
        $this->emailValidator = $emailFieldValidator;
        $this->errors = [];
    }

    public function validate(array $data)
    {
        $errors = [];

        if (!empty($data['email'])) {
            if (!$this->emailValidator->isValid($data['email'])) {
                $errors['email'] = $this->emailValidator->getErrors();
            }
        } else {
            $errors['email'] = 'Email field is required';
        }

        if (empty($data['password'])) {
            $errors['password'] = 'Password field is required';
        }

        $this->errors = $errors;
        return empty($errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

}