<?php

declare(strict_types=1);

namespace TinyTalkMessages\Validation\Tests;

use PHPUnit\Framework\TestCase;
use TinyTalkMessages\Validation\Interfaces\ValidatorInterface;
use TinyTalkMessages\Validation\Data\Errors;
use TinyTalkMessages\Validation\Data\ErrorField;

final class ValidatorInlineTest extends TestCase
{
    /**
     * Simple validator that checks if email is valid.
     * @return ValidatorInterface
     */
    private function getValidator(): ValidatorInterface
    {
        return new class implements ValidatorInterface {
            private Errors $errors;

            public function validate(array $data): bool
            {
                $this->errors = new Errors();
                $valid = true;
                if (empty($data)) {
                    $this->errors->add(new ErrorField('email', 'Email is required.'));
                    $valid = false;
                } else {
                    $email = $data['email'] ?? null;
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $this->errors->add(new ErrorField('email', 'Invalid email.'));
                        $valid = false;
                    }
                }

                return $valid;
            }

            public function getErrors(): Errors
            {
                return $this->errors;
            }
        };
    }

    /**
     * Test with empty data
     * @return void
     */
    public function testEmptyData(): void
    {
        $validator = $this->getValidator();
        $this->assertFalse($validator->validate([]));
        $errors = $validator->getErrors();
        $this->assertCount(1, $errors);
        $this->assertSame('email', $errors->all()[0]->field);
    }

    /**
     * Test with invalid email
     * @return void
     */
    public function testInvalidEmail(): void
    {
        $validator = $this->getValidator();
        $this->assertFalse($validator->validate(['email' => 'bad@@']));
        $errors = $validator->getErrors();
        $this->assertCount(1, $errors);
        $this->assertSame('Invalid email.', $errors->all()[0]->message);
    }

    /**
     * Test with valid email
     * @return void
     */
    public function testValidEmail(): void
    {
        $validator = $this->getValidator();
        $this->assertTrue($validator->validate(['email' => 'demo@mail.com']));
        $this->assertCount(0, $validator->getErrors());
    }
}