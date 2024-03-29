<?php

namespace Cobra\Auth\Validator;

use Cobra\Interfaces\Auth\User\UserInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Validator\Validator;

/**
 * User Single Device Login Validator
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
class UserSingleDeviceLoginValidator extends Validator
{
    /**
     * Error message
     *
     * @var string
     */
    protected $message = 'Your account has been logged into from another device';

    /**
     * Single device ID
     *
     * @var string
     */
    protected $deviceId;

    /**
     * Sets the field name to compare
     *
     * @param UserInterface $user
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->deviceId = $request->getSession()->get('device_id');
    }

    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'user-single-device-login';
    }

    /**
     * Main method to validate the passed value
     *
     * @param  UserInterface $user
     * @return bool
     */
    public function validate($user): bool
    {
        if (config('auth.single_device_signin') === true) {
            return $user->device_id === $this->deviceId;
        };
        return true;
    }
}
