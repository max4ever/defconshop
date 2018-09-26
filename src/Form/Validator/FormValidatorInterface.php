<?php

namespace Defconshop\Form\Validator;

interface FormValidatorInterface
{
    public function isValid($data): bool;

    public function getErrors(): array/*of strings*/
    ;
}