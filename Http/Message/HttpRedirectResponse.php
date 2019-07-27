<?php

namespace Cobra\Http\Message;

use Cobra\Http\Traits\OutputsHeaders;

/**
 * Http Redirect Response
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
class HttpRedirectResponse extends HttpResponse
{
    use OutputsHeaders;

    /**
     * HTTP status code
     *
     * @var integer
     */
    protected $statusCode = 302;

    /**
     * Sets the response default properties
     *
     * @param integer $statusCode
     * @param string  $protocol
     * @param array   $headers
     * @param mixed   $body
     */
    public function __construct(int $statusCode = 302, string $protocol = null, array $headers = [], $body = null)
    {
        parent::__construct($statusCode, $protocol, $headers, $body);
    }

    /**
     * Outputs the HTTP response
     *
     * @return mixed
     */
    public function output()
    {
        $this->outputHeaders($this->getHeaders());
        $this->outputHeader(
            'Location',
            $this->getHeader('Location')[0],
            true,
            301
        );
    }
}
