<?php

namespace TinyTalkMessages\Validation\Tests;

use PHPUnit\Framework\TestCase;
use TinyTalkMessages\Validation\Interfaces\RuleInterface;

final class RulesTest extends TestCase
{
    public const string INVALID_EMAIL_MESSAGE = 'Invalid email';

    /**
     * Simple rule
     * @return RuleInterface
     */
    public function getRule(): RuleInterface
    {
        return new class implements RuleInterface {
            private ?string $message = null;

            public function check(string $field, mixed $value): bool
            {
                $this->message = null;
                if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
                    $this->message = RulesTest::INVALID_EMAIL_MESSAGE;

                    return false;
                }

                return true;
            }

            public function message(): ?string
            {
                return $this->message;
            }
        };
    }

    /**
     * @return void
     */
    public function testRule(): void
    {
        $rule = $this->getRule();
        $this->assertTrue($rule->check('email', 'test@example.com')); // The rule works with valid values
        $this->assertNull($rule->message()); // The rule does not have a message after successful validation

        $this->assertFalse($rule->check('email', 'bad@')); //
        $this->assertSame(self::INVALID_EMAIL_MESSAGE, $rule->message());
    }
}