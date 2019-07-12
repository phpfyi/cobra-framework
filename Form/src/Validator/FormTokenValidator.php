<?php

namespace Cobra\Form\Validator;

use Cobra\Validator\Validator;

/**
 * Form Token Validator
 *
 * Validates a CSRF token form field.
 *
 * @category  Form
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class FormTokenValidator extends Validator
{
    /**
     * Error message
     *
     * @var string
     */
    protected $message = 'Invalid token';

    /**
     * Request form CSRF token
     *
     * @var string
     */
    protected $formToken;

    /**
     * Request session CSRF token
     *
     * @var string
     */
    protected $sessionToken;

    /**
     * Sets the required properties
     *
     * @param string $formToken
     * @param string $sessionToken
     */
    public function __construct(string $formToken, string $sessionToken)
    {
        $this->formToken = trim($formToken);
        $this->sessionToken = trim($sessionToken);
    }

    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'form-token';
    }

    /**
     * Main method to validate the passed value
     *
     * @param  mixed $value
     * @return bool
     */
    public function validate($value = null): bool
    {
        if ($this->formToken === '') {
            $this->message = 'Empty form token in request';
            return false;
        }
        if ($this->sessionToken === '') {
            $this->message = 'Empty session token in request';
            return false;
        }
        if ($this->formToken !== $this->sessionToken) {
            $this->message = 'Mismatch token in request';
            return false;
        }
        return true;
    }
}
