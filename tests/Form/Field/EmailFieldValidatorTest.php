<?php

use PHPUnit\Framework\TestCase;

class EmailFieldValidatorTest extends TestCase
{
    public function testGoodEmail(): void
    {
        $emailValidator = new \Defconshop\Form\Validator\EmailFieldValidator();
        $this->assertTrue($emailValidator->isValid("home@there.com"));
    }

    public function testBadEmail()
    {
        $emailValidator = new \Defconshop\Form\Validator\EmailFieldValidator();
        $this->assertFalse($emailValidator->isValid("home@there."));
    }

}