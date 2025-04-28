<?php

use TinyTalkMessages\Validation\Data\ErrorField;
use TinyTalkMessages\Validation\Data\Errors;
use TinyTalkMessages\Validation\Interfaces\RuleInterface;
use TinyTalkMessages\Validation\Interfaces\ValidatorInterface;

// Example rule
final readonly class Required implements RuleInterface
{
    public function __construct(private ExampleValidator $validator)
    {
    }

    public function check(string $field, mixed $value): bool
    {
        if ($value === null) {
            $this->validator->getErrors()->add(new ErrorField($field, "$field is required."));

            return false;
        }

        return true;
    }

    public function message(): ?string
    {
        return null;
    }
}

final class ExampleValidator implements ValidatorInterface
{
    private const array REQUIRED_FIELDS = [
        'email',
        'password',
    ];

    private Errors $errors;

    public function __construct()
    {
        $this->errors = new Errors();
    }

    public function validate(array $data): bool
    {
        $hasNotErrors = false;
        $rule = new Required($this);

        foreach (self::REQUIRED_FIELDS as $field) {
            if ($rule->check($field, $data['field'] ?? null)) {
                $hasNotErrors = true;
            }
        }

        return $hasNotErrors;
    }

    public function getErrors(): Errors
    {
        return $this->errors;
    }
}

$validator = new ExampleValidator();
$validator->validate([]); // false
echo count($validator->getErrors()); // -> 2