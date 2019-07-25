<?php

namespace Cobra\Auth\Traits;

use Cobra\Interfaces\Http\Message\ResponseInterface;

/**
 * Login Redirect
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
trait RedirectsToLogin
{
    /**
     * Returns a redirect instance with the URI set to the login page
     *
     * @param object $object
     * @return ResponseInterface
     */
    protected function redirectToLogin(object $object): ResponseInterface
    {
        $location = sprintf(
            '%s?%s',
            config('auth.login_route'),
            http_build_query(['redirect' => $object->getRequest()->getUri()->getPath()])
        );
        return http_redirect_response($object, $location, 302);
    }
}
