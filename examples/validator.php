<?php

use TinyTalkMessages\Validation\Interfaces\ValidatorInterface;

class Validator implements ValidatorInterface
{
    private \TinyTalkMessages\Validation\Data\Errors $errors;

    public function validate(array $data): bool
    {
        $this->errors = new TinyTalkMessages\Validation\Data\Errors();
        $valid = true;
        if (empty($data)) {
            $this->errors->add(new \TinyTalkMessages\Validation\Data\ErrorField('email', 'Email is required.'));
            $valid = false;
        }
        $email = $data['email'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors->add(new \TinyTalkMessages\Validation\Data\ErrorField('email', 'Invalid email.'));
            $valid = false;
        }

        return $valid;
    }

    public function getErrors(): \TinyTalkMessages\Validation\Data\Errors
    {
        return $this->errors;
    }
}

$validator = new Validator();

$validator->validate([]); // false
$validator->getErrors();
// Errors {
//     errors =>
//          { 0 => ErrorField (field => 'email', message => 'Email is required.')}
//     }
// }

$validator->validate(['email' => 'example@example.com']); // true