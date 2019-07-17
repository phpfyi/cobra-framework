<?php

use Cobra\Interfaces\Http\Message\RequestInterface;

/**
 * Request function sets
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

if (! function_exists('http_status_codes')) {
    /**
     * Returns an array of HTTP codes
     *
     * @return array
     */
    function http_status_codes(): array
    {
        return array_merge(
            config('http.200_codes'),
            config('http.300_codes'),
            config('http.400_codes'),
            config('http.500_codes')
        );
    }
}

if (! function_exists('is_https')) {
    /**
     * Cheks if a request is HTTPS
     *
     * @param RequestInterface $request
     * @return boolean
     */
    function is_https(RequestInterface $request): bool
    {
        return strtolower(
            $request->getServerParam('HTTPS')
        ) == 'on'
        || $request->getServerParam('SERVER_PORT') == 443;
    }
}

if (! function_exists('is_ajax')) {
    /**
     * Cheks if a request is via AJAX
     *
     * @param RequestInterface $request
     * @return boolean
     */
    function is_ajax(RequestInterface $request): bool
    {
        return strtolower(
            $request->getServerParam('HTTP_X_REQUESTED_WITH')
        ) === 'xmlhttprequest'
        || $request->getUri()->getVar('__amp_source_origin');
    }
}
