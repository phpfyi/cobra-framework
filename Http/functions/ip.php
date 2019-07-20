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
                        function ($ip) use (&$ips) {
                            $ips[] = trim($ip);
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
        return array_map(function ($ip) use (&$hostnames) {
            if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                return gethostbyaddr($ip);
            }
        }, explode(',', $request->getIP()));
    }
}

if (! function_exists('in_ip_range')) {
    /**
     * Checks if an IP address is in a range
     *
     * @param string $ip
     * @param string $min
     * @param string $max
     * @return boolean
     */
    function ip_in_range(string $ip, string $min, string $max): bool
    {
        $ip  = ip2long($ip);
        $min = ip2long($min);
        $max = ip2long($max);

        return $ip >= $min && $ip <= $max;
    }
}
