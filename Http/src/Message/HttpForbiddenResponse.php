<?php

namespace Cobra\Http\Message;

/**
 * Http Forbidden Response
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
class HttpForbiddenResponse extends HttpResponse
{
    /**
     * HTTP status code
     *
     * @var integer
     */
    protected $statusCode = 403;

    /**
     * Sets the response default properties
     *
     * @param integer $statusCode
     * @param string  $protocol
     * @param array   $headers
     * @param mixed   $body
     */
    public function __construct(int $statusCode = 403, string $protocol = null, array $headers = [], $body = null)
    {
        parent::__construct($statusCode, $protocol, $headers, $body);
    }
}
