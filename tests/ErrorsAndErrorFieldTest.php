<?php

declare(strict_types=1);

namespace TinyTalkMessages\Validation\Tests;

use PHPUnit\Framework\TestCase;
use TinyTalkMessages\Validation\Data\Errors;
use TinyTalkMessages\Validation\Data\ErrorField;

final class ErrorsAndErrorFieldTest extends TestCase
{
    /**
     * Test that ErrorField stores data
     *
     * @return void
     */
    public function testErrorFieldStoresData(): void
    {
        $error = new ErrorField('field', 'Some message');
        $this->assertSame('field', $error->field);
        $this->assertSame('Some message', $error->message);
    }

    /**
     * Test that Errors can store multiple ErrorFields
     *
     * @return void
     */
    public function testAddAndRetrieveErrors(): void
    {
        $errors = new Errors();

        $errors->add(new ErrorField('email', 'Email required'));
        $errors->add(new ErrorField('password', 'Password required'));

        $all = $errors->all();
        $this->assertCount(2, $all);
        $this->assertSame('email', $all[0]->field);
        $this->assertSame('Email required', $all[0]->message);
        $this->assertSame('password', $all[1]->field);
        $this->assertSame('Password required', $all[1]->message);
    }

    /**
     * Test that Errors implements Countable and Iterator
     *
     * @return void
     */
    public function testCountableAndIterator(): void
    {
        $errors = new Errors();
        $this->assertCount(0, $errors);

        $errors->add(new ErrorField('f', 'm'));
        $this->assertCount(1, $errors);

        $array = iterator_to_array($errors);
        $this->assertCount(1, $array);
        $this->assertInstanceOf(ErrorField::class, $array[0]);
    }
}