<?php

namespace Cobra\Interfaces\Validator;

/**
 * Validator Interface
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
interface ValidatorInterface
{
    /**
     * Returns the validator name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Performs the validation and returns whether it has been successful.
     *
     * @param  mixed $value
     * @return boolean
     */
    public function validate($value): bool;

    /**
     * Sets the validator error message.
     *
     * @param  string $message
     * @return ValidatorInterface
     */
    public function setMessage(string $message): ValidatorInterface;

    /**
     * Returns the validator error message.
     *
     * @return string
     */
    public function getMessage(): string;
}
