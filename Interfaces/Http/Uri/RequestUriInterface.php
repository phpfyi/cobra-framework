<?php

namespace Cobra\Interfaces\Http\Uri;

use Psr\Http\Message\UriInterface;

/**
 * Request Uri Interface
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
interface RequestUriInterface extends UriInterface
{
    /**
     * Checks if the current request ends with /
     *
     * @return boolean
     */
    public function endsWithSlash(): bool;

    /**
     * Checks if the current host starts with www
     *
     * @return boolean
     */
    public function isWwwHostname(): bool;

    /**
     * Gets a segment from the request URI path
     *
     * @param  int|null $index
     * @return string
     */
    public function getSegment($index = null): string;

    /**
     * Returns a query string key value or null
     *
     * @param  string $name
     * @return string|null
     */
    public function getVar(string $name):? string;
}
