<?php

namespace TinyTalkMessages\Validation\Interfaces;

use TinyTalkMessages\Validation\Data\Errors;

/**
 * Represents a validator that handles multiple validation rules and collects errors.
 * This interface defines the contract for validation operations.
 */
interface ValidatorInterface
{
    /**
     * Run validation
     * @param array $data
     * @return bool
     */
    public function validate(array $data): bool;

    /**
     * Contains validation errors
     * @return Errors
     */
    public function getErrors(): Errors;
}