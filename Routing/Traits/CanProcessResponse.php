<?php

namespace Cobra\Routing\Traits;

use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Http\Message\HttpForbiddenResponse;
use Cobra\Http\Message\HttpRedirectResponse;
use Cobra\Http\Message\HttpServiceUnavailableResponse;

/**
 * Can Process Trait
 *
 * @category  Routing
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
trait CanProcessResponse
{
    /**
     * Checks if the response processing can continue.
     *
     * @return boolean
     */
    protected function canProcess(ResponseInterface $response): bool
    {
        return !$response instanceof HttpRedirectResponse
        && !$response instanceof HttpForbiddenResponse
        && !$response instanceof HttpServiceUnavailableResponse;
    }
}
