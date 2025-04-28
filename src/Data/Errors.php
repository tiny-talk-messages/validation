<?php

namespace TinyTalkMessages\Validation\Data;

/**
 * Collection class for ErrorField objects
 */
class Errors implements \IteratorAggregate, \Countable
{
    /**
     * @var ErrorField[]
     */
    private array $errors = [];

    /**
     * Add an error
     */
    public function add(ErrorField $error): void
    {
        $this->errors[] = $error;
    }

    /**
     * Get all the errors
     *
     * @return ErrorField[]
     */
    public function all(): array
    {
        return $this->errors;
    }

    /**
     * @return \ArrayIterator<ErrorField>
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->errors);
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->errors);
    }
}
