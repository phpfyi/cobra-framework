<?php

namespace Cobra\Http\Traits;

use InvalidArgumentException;
use Cobra\Interfaces\Http\Message\ResponseInterface;

/**
 * Immutable HTTP Response trait
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
trait ImmutableHttpResponse
{
    /**
     * Return an instance with the specified status code and, optionally, reason phrase.
     *
     * @param  int    $code         The 3-digit integer result code to set.
     * @param  string $reasonPhrase
     * @return static
     * @throws InvalidArgumentException For invalid status code arguments.
     */
    public function withStatus($code, $reasonPhrase = ''): ResponseInterface
    {
        $clone = clone $this;
        $clone->statusCode = arg_is_int($code);
        return $clone;
    }
}
