<?php

namespace Cobra\Validator;

use Cobra\Interfaces\Validator\ValidatorInterface;
use Cobra\Object\AbstractObject;

/**
 * Validator
 *
 * Abstract base validation class.
 *
 * @category  Validator
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
abstract class Validator extends AbstractObject implements ValidatorInterface
{
    /**
     * Unsuccessful validation error message
     *
     * @var string
     */
    protected $message = 'Required';

    /**
     * Returns the validator name.
     *
     * @return string
     */
    abstract public function getName(): string;

    /**
     * Performs the validation and returns whether it has been successful.
     *
     * @param  mixed $value
     * @return boolean
     */
    abstract public function validate($value): bool;

    /**
     * Sets the validator error message.
     *
     * @param  string $message
     * @return ValidatorInterface
     */
    public function setMessage(string $message): ValidatorInterface
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Returns the validator error message.
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
