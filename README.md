# TinyTalkMessages Validation

A lightweight, type-safe validation library for PHP 8.3+ focused on simple error declaration and extensible validation rules.

## Features

- **Object-based error declaration:** Use `ErrorField` to represent specific validation errors.
- **Error collection:** Gather multiple errors in a single `Errors` collection.
- **Extensible interfaces:** Create your own rules and validators with core interfaces.
- **Minimal dependencies:** Requires only PHP, making it suitable for any PHP project.

## Requirements

- PHP ^8.3
- ([For Development/Testing] PHPUnit ^12.1)

## Installation

Install via Composer:

```bash
composer require tiny-talk-messages/validation
```

## Quick Start

### Basic Usage

```php
use TinyTalkMessages\Validation\Data\ErrorField;
use TinyTalkMessages\Validation\Data\Errors;

$errors = new Errors();
$errors->add(new ErrorField('email', 'This value is not a valid email.'));
$errors->add(new ErrorField('password', 'Password is too short.'));

// Handle errors
if (count($errors) > 0) {
    foreach ($errors as $error) {
        echo $error->field . ': ' . $error->message . PHP_EOL;
    }
}
```

### Error Organization

The `Errors` collection allows you to accumulate errors and propagate them through validation layers. Each error references its associated field, making integration with forms or APIs simple.

### Custom Rules & Validators

You can implement your own logic by creating classes that follow these interfaces:

- `RuleInterface` – For individual validation rules.
- `ValidatorInterface` – For complex validators.

Refer to the `src/Interfaces` directory for the interface definitions.

## Project Structure

```
src/
  Data/
    ErrorField.php         # Field-specific validation error
    Errors.php             # Error collection class
  Interfaces/
    RuleInterface.php      # Interface for custom rules
    ValidatorInterface.php # Interface for validators
examples/                  # Implementation examples
  hooked-rule-validation.php
  rules.php
  validator.php
```

## Running Tests

To install development dependencies and run the tests:

```bash
composer install
composer test
```

## Code Examples

A rich set of usage examples is available in the [`examples/`](./examples/) directory:
- [rules.php](./examples/rules.php) – Examples of custom validation rule implementations (like Email and OptionalEmail).
- [validator.php](./examples/validator.php) – Example of a custom validator and working with the error collection.
- [hooked-rule-validation.php](./examples/hooked-rule-validation.php) – Example with a "hooked rule" and integration of validation errors into the validator interface.

We recommend reviewing these examples for a better understanding of the library's structure and extensibility.


## Why Use This Package?

- **Minimalist:** Focuses only on error declaration and validation abstraction.
- **Type Safety:** Designed for strong typing and reliability.
- **Framework-Agnostic:** Integrates easily with any PHP framework or standalone scripts.
- **Extensible:** Easily extendable to fit custom validation needs.

## Feedback & Contributions

Questions or suggestions? Open an issue or submit a pull request!

---

**License:** MIT
