<?php

namespace Cobra\Http\Stream;

use Cobra\Http\Stream\Stream;

/**
 * JSON Stream
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
class JsonStream extends Stream
{
    /**
     * Returns HTTP safe string representation of the content.
     *
     * @return string
     */
    public function __toString(): string
    {
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }
}
