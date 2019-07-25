<?php

namespace Cobra\Auth\Validator;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Validator\Validator;

/**
 * Password Confirm Validator
 *
 * @category  Auth
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class PasswordConfirmValidator extends Validator
{
    /**
     * Error message
     *
     * @var string
     */
    protected $message = 'Passwords do not match';

    /**
     * Field name to compare
     *
     * @var string
     */
    private $password;

    /**
     * Request data
     *
     * @var array
     */
    private $data= [];

    /**
     * Sets the required parameters
     *
     * @param RequestInterface $request
     * @param string $password
     */
    public function __construct(RequestInterface $request, string $password = 'password')
    {
        $this->data = $request->postVars();
        $this->password = $password;
    }

    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'password-confirm';
    }

    /**
     * Main method to validate the passed value
     *
     * @param  mixed $value
     * @return bool
     */
    public function validate($value = null): bool
    {
        if (!array_key_exists($this->password, $this->data)) {
            return false;
        }
        if ($this->data[$this->password] !== $value) {
            return false;
        }
        return true;
    }
}
