<?php

namespace Cobra\Http\Traits;

use Cobra\Interfaces\Http\Message\ResponseInterface;

/**
 * Uses Response Trait
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
trait UsesResponse
{
    /**
     * ResponseInterface instance
     *
     * @var ResponseInterface
     */
    protected $response;

    /**
     * Sets the response instance.
     *
     * @param  ResponseInterface $response
     * @return static
     */
    public function setResponse(ResponseInterface $response): self
    {
        $this->response = $response;
        return $this;
    }

    /**
     * Returns the response instance.
     *
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
