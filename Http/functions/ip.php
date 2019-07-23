<?php

use Cobra\Interfaces\Http\Message\RequestInterface;

/**
 * IP function sets
 *
 * @category  HTTP
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */

if (! function_exists('request_ip')) {
    /**
     * Returns the IP address from a request
     *
     * @param RequestInterface $request
     * @return string
     */
    function request_ip(RequestInterface $request): string
    {
        $ips = [];
        $params = $request->getServerParams();
        array_map(
            function ($header) use (&$ips, $params) {
                if (array_key_exists($header, $params)) {
                    array_map(
                        function ($ipAddress) use (&$ips) {
                            $ips[] = trim($ipAddress);
                        },
                        explode(',', $params[$header])
                    );
                }
            },
            config('http.ip_headers')
        );
        return (string) implode(',', array_unique($ips));
    }
}

if (! function_exists('ip_hostnames')) {
    /**
     * Returns an array of hostnames from an IP address list
     *
     * @param RequestInterface $request
     * @return array
     */
    function ip_hostnames(RequestInterface $request): array
    {
        return array_map(function ($ipAddress) use (&$hostnames) {
            if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                return gethostbyaddr($ipAddress);
            }
        }, explode(',', $request->getIP()));
    }
}

if (! function_exists('in_ip_range')) {
    /**
     * Checks if an IP address is in a range
     *
     * @param string $ipAddress
     * @param string $min
     * @param string $max
     * @return boolean
     */
    function ip_in_range(string $ipAddress, string $min, string $max): bool
    {
        $ipAddress = ip2long($ipAddress);
        $min = ip2long($min);
        $max = ip2long($max);

        return $ipAddress >= $min && $ipAddress <= $max;
    }
}
