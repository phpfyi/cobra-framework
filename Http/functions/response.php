<?php

use Cobra\Http\Message\HttpForbiddenResponse;
use Cobra\Http\Message\HttpRedirectResponse;

/**
 * Response function sets
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

if (! function_exists('http_forbidden_response')) {
    /**
     * Returns a HttpForbiddenResponse instance
     *
     * @param object $object
     * @return HttpForbiddenResponse
     */
    function http_forbidden_response(object $object): HttpForbiddenResponse
    {
        return HttpForbiddenResponse::resolve()->setSession(
            $object->getResponse()->getSession()
        );
    }
}

if (! function_exists('http_redirect_response')) {
    /**
     * Returns a HttpRedirectResponse instance
     *
     * @param object $object
     * @param string $location
     * @param integer $code
     * @return HttpRedirectResponse
     */
    function http_redirect_response(object $object, string $location, int $code = 301): HttpRedirectResponse
    {
        return HttpRedirectResponse::resolve($code)
            ->addHeader('Location', $location)
            ->setSession($object->getResponse()->getSession());
    }
}
