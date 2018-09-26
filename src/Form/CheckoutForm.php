<?php

namespace Defconshop\Form;

class CheckoutForm extends AbstractForm
{
    const PAYMENT_METHODS = ['method1', 'method2'];

    public function validate(array $data)
    {
        $errors = [];

        if (empty($data['payment_method'])) {
            $errors['payment_method'] = 'Please select a payment method';
        }

        if (!in_array($data['payment_method'], self::PAYMENT_METHODS)) {
            $errors['payment_method'] = 'Select a valid payment method';
        }

        $this->errors = $errors;
        return empty($errors);
    }

}