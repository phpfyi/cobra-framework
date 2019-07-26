<?php

namespace Cobra\Html\Traits;

use Cobra\Interfaces\Html\HtmlInterface;

/**
 * Renders As HTML Trait
 *
 * @category  HTML
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
trait RendersAsHtml
{
    /**
     * Returns the rendered element HTML
     *
     * @return string
     */
    public function __toString(): string
    {
        return container_resolve(HtmlInterface::class)->render($this);
    }
}
