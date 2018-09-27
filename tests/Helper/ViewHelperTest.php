<?php

use PHPUnit\Framework\TestCase;

class ViewHelperTest extends TestCase
{
    public function testMissingPassword(): void
    {
        $emailValidator = new \Defconshop\Form\Validator\EmailFieldValidator();
        $form = new \Defconshop\Form\LoginForm($emailValidator);

        $result = $form->validate(['email' => '123@123.com', 'password' => '']);
        $this->assertFalse($result);
    }

}