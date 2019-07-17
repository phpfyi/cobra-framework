<?php

namespace Cobra\Interfaces\Http\Message;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Request Interface
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
interface RequestInterface extends ServerRequestInterface
{
    /**
     * Retrieves a cookie if it exists
     *
     * @param  string $name
     * @return string|null
     */
    public function getCookieParam(string $name):? string;

    /**
     * Get the HTTP referer
     *
     * @return string
     */
    public function getReferer(): string;

    /**
     * Get the request IP address
     *
     * @return string
     */
    public function getIP(): string;

    /**
     * Get the request host by address
     *
     * @return array
     */
    public function getHostByAddr(): array;

    /**
     * Checks if the current request is HTTPS
     *
     * @return boolean
     */
    public function isHttps(): bool;

    /**
     * Checks if the request is an AJAX request
     *
     * @return boolean
     */
    public function isAjax(): bool;

    /**
     * Is a post request
     *
     * @return boolean
     */
    public function isPost(): bool;

    /**
     * Returns all request post vars
     *
     * @return array
     */
    public function postVars(): array;

    /**
     * Returns a post value
     *
     * @param  string $name
     * @return mixed
     */
    public function postVar(string $name);
}
