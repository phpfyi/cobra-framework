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
    protected $ip;

    /**
     * Disallowed IPs
     *
     * @var array
     */
    protected $ips = [];

    /**
     * Sets the required properties
     *
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->ip = $request->getIP();
        $this->ips = env('DISALLOW_IPS');
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
        foreach (explode(',', $this->ip) as $origin) {
            foreach ($this->ips as $ip) {
                if (is_array($ip) && ip_in_range($origin, $ip[0], $ip[1])) {
                    return false;
                }
                if ($origin === $ip) {
                    return false;
                }
            }
        }
        return true;
    }
}
