<?php

namespace Cobra\Http\Traits;

use Psr\Http\Message\MessageInterface;

/**
 * Clone Request Trait
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
trait CloneRequest
{
    /**
     * Clones the current instance with passed header(s).
     *
     * @param  string       $name
     * @param  string|array $value
     * @return MessageInterface
     */
    protected function cloneWithHeader(string $name, $value): MessageInterface
    {
        $clone = clone $this;
        $clone->headers[$name] = (array) arg_is_string_or_array($value);
        return $clone;
    }
}
