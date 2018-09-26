<?php

namespace Defconshop\Form;

abstract class AbstractForm
{
    protected $errors = [];

    public function getErrors()
    {
        return $this->errors;
    }
}