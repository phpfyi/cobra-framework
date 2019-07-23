<?php

namespace Cobra\Security\Validator;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Validator\Validator;

/**
 * IP Address Validator
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
class IpAddressValidator extends Validator
{
    /**
     * Request IP
     *
     * @var string
     */
    protected $ipAddress;

    /**
     * Disallowed IPs
     *
     * @var array
     */
    protected $ipAddresses = [];

    /**
     * Sets the required properties
     *
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->ipAddress = $request->getIP();
        $this->ipAddresses = env('DISALLOW_IPS');
    }

    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'request-ip';
    }

    /**
     * Main method to validate the passed value
     *
     * @param  mixed $value
     * @return bool
     */
    public function validate($value = null): bool
    {
        foreach (explode(',', $this->ipAddress) as $origin) {
            foreach ($this->ipAddresses as $ipAddress) {
                if (is_array($ipAddress) && ip_in_range($origin, $ipAddress[0], $ipAddress[1])) {
                    return false;
                }
                if ($origin === $ipAddress) {
                    return false;
                }
            }
        }
        return true;
    }
}
