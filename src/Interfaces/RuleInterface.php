<?php

namespace TinyTalkMessages\Validation\Interfaces;

/**
 * Represents the basic validation rule that performs a single validation check.
 * This interface defines the contract for individual validation rules.
 */

interface RuleInterface
{
    /**
     * Performs a value check and returns `true` if the check was passed or skipped.
     * If the check failed, `false` is returned and a message is created that can be extracted `message()`
     *
     * @param string $field
     * @param mixed $value
     * @return bool
     * @see message()
     *
     */
    public function check(string $field, mixed $value): bool;

    /**
     * Contains an error message
     *
     * @return string|null
     */
    public function message(): ?string;
}