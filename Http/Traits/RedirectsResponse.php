<?php

namespace Cobra\Http\Traits;

use Cobra\Http\Message\HttpRedirectResponse;
use Cobra\Http\Traits\UsesResponse;

/**
 * Redirects Response Trait
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
trait RedirectsResponse
{
    use UsesResponse;

    /**
     * Http Redirect Response instance
     *
     * @var HttpRedirectResponse
     */
    protected $response;

    /**
     * Sets and returns a Http Redirect Response instance.
     *
     * @param  string  $location
     * @param  integer $code
     * @return HttpRedirectResponse
     */
    public function redirect(string $location, $code = 302): HttpRedirectResponse
    {
        return $this->response = http_redirect_response($this, $location, $code);
    }
}
