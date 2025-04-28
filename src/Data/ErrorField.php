<?php

namespace TinyTalkMessages\Validation\Data;

/**
 * A class representing a single field error during validation
 */
readonly class ErrorField
{
    public function __construct(
        public string $field,
        public string $message
    ) {
    }
}