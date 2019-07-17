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
     * Request hostnames
     *
     * @var array
     */
    protected $hosts = [];

    /**
     * Disallowed hostnames
     *
     * @var array
     */
    protected $hostnames = [];

    /**
     * Sets the required properties
     *
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->hosts = $request->getHostByAddr();
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
     * @param  mixed $value
     * @return bool
     */
    public function validate($value = null): bool
    {
        return empty(
            array_intersect(
                $this->hosts,
                $this->hostnames
            )
        );
    }
}
