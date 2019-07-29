<?php

namespace Cobra\Http\Stream;

use Cobra\Http\Stream\Stream;
use Cobra\Interfaces\View\Transform\ViewMinifierInterface;

/**
 * HTML Stream
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
class HtmlStream extends Stream
{
    /**
     * Returns HTTP safe string representation of the content.
     *
     * @return string
     */
    public function __toString(): string
    {
        return container_resolve(
            ViewMinifierInterface::class,
            [
                $this->data
            ]
        )->getOutput();
    }
}
