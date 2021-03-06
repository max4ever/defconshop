<?php

namespace Defconshop\Form;

use Defconshop\Form\Validator\EmailFieldValidator;

class RegisterForm extends AbstractForm
{
    private $emailValidator;

    public function __construct(EmailFieldValidator $emailFieldValidator)
    {
        $this->emailValidator = $emailFieldValidator;
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

        if (empty($data['name'])) {
            $errors['name'] = 'Name field is required';
        }

        if (empty($data['password1'])) {
            $errors['password1'] = 'Password field is required';
        }

        if (empty($data['password2'])) {
            $errors['password2'] = 'Confirm password field is required';
        }

        if (!empty($data['password1']) && !empty($data['password2'])) {
            if ($data['password1'] != $data['password2']) {
                $errors['password2'] = "Passwords don't match";
            }
        }

        $this->errors = $errors;
        return empty($errors);
    }

}