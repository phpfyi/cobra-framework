<?php

namespace Cobra\Security\Validator;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Validator\Validator;

/**
 * Hostname Validator
 *
 * @category  Security
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class HostnameValidator extends Validator
{
    /**
     * Disallowed hostnames
     *
     * @var array
     */
    protected $hostnames = [];

    /**
     * Sets the required properties
     */
    public function __construct()
    {
        $this->hostnames = env('DISALLOW_HOSTS');
    }

    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'request-hostname';
    }

    /**
     * Main method to validate the passed value
     *
     * @param  RequestInterface $request
     * @return bool
     */
    public function validate($request): bool
    {
        return empty(
            array_intersect(
                $request->getHostByAddr(),
                $this->hostnames
            )
        );
    }
}
