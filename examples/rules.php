<?php

use TinyTalkMessages\Validation\Interfaces\RuleInterface;

// Simple email rule
final class Email implements RuleInterface
{
    private string $message;

    public function check(string $field, mixed $value): bool
    {
        $this->message = '';

        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            $this->message = 'Email is not valid';

            return false;
        }

        return true;
    }

    public function message(): ?string
    {
        return $this->message;
    }
}

$rule = new Email();
$emailCheck = $rule->check('email', 'example.com'); // false;
echo $rule->message(); // -> Email is not valid

$emailCheck = $rule->check('email', 'test@example.com'); // true;



// Optional email rule
final class OptionalEmail implements RuleInterface
{
    private string $message;

    public function check(string $field, mixed $value): bool
    {
        $this->message = '';
        if (!empty($value) && filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            $this->message = 'Email is not valid';

            return false;
        }

        return true;
    }

    public function message(): ?string
    {
        return $this->message;
    }
}

$rule = new Email();
$rule->check('email', ''); // true;
$rule->check('email', 'test@example.com'); // true;
