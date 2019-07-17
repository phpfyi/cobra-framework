<?php

namespace Cobra\Http\Traits;

use Cobra\Interfaces\Http\Message\RequestInterface;

/**
 * Handles Request Trait
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
trait UsesRequest
{
    /**
     * RequestInterface instance
     *
     * @var RequestInterface
     */
    protected $request;

    /**
     * Sets the request instance.
     *
     * @param  RequestInterface $request
     * @return static
     */
    public function setRequest(RequestInterface $request): self
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Returns the request instance.
     *
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}
