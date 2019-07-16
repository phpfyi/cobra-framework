<?php

namespace Cobra\Amp\Traits;

use Cobra\Interfaces\Http\Message\ResponseInterface;

/**
 * AMP Response Headers
 *
 * @category  AMP
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
trait AmpResponseHeaders
{
    /**
     * Sets AMP HTTP headers on a response.
     *
     * @param ResponseInterface $response
     * @param string $origin
     * @param integer $maxAge
     * @return void
     */
    public function setAmpHeaders(
        ResponseInterface $response,
        string $origin,
        bool $credentials = true,
        int $maxAge = 86400
    ): void {
        $response
            ->addHeader('Access-Control-Allow-Origin', $origin)
            ->addHeader('AMP-Access-Control-Allow-Source-Origin', $origin)
            ->addHeader('Access-Control-Expose-Headers', 'AMP-Access-Control-Allow-Source-Origin')
            ->addHeader('Access-Control-Allow-Credentials', $credentials)
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('Access-Control-Max-Age', $maxAge)
            ->addHeader('Cache-Control', 'private, no-cache');
    }
}
