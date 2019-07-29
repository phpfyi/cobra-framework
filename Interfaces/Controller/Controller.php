<?php

namespace Cobra\Interfaces\Controller;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;

/**
 * Controller interface
 *
 * @category  Controller
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
interface ControllerInterface
{
    /**
     * Handles the request object
     *
     * @param  RequestInterface $request
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request): ResponseInterface;

    /**
     * Sets a response to redirect back to the previous URL
     *
     * @return void
     */
    public function back(): void;

    /**
     * Sets a HTTP error response
     *
     * @param  integer $code
     * @return void
     */
    public function setHttpError(int $code): void;
}
