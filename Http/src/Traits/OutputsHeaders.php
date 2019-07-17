<?php

namespace Cobra\Http\Traits;

/**
 * Outputs Headers Trait
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
trait OutputsHeaders
{
    /**
     * Outputs an array of HTTP header.
     *
     * @param  array $headers
     * @return void
     */
    protected function outputHeaders(array $headers): void
    {
        array_map(
            function ($name, $headers) {
                array_map(
                    function ($header) use ($name) {
                        $this->outputHeader($name, $header);
                    },
                    (array) $headers
                );
            },
            array_keys($headers),
            $headers
        );
    }

    /**
     * Outputs a HTTP header.
     *
     * @param  string $name
     * @param  string $value
     * @return void
     */
    protected function outputHeader(string $name, string $value): void
    {
        header(
            sprintf('%s:%s', $name, $value),
            true
        );
    }
}
