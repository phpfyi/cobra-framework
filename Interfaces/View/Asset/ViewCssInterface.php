<?php

namespace Cobra\Interfaces\View\Asset;

use Cobra\Html\HtmlStyleElement;

/**
 * View CSS Interface
 *
 * @category  View
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
interface ViewCssInterface
{
    /**
     * Sets an inline CSS HTML tag
     *
     * @param  string $path
     * @param  array  $attributes
     * @return HtmlStyleElement
     */
    public function setInline(string $path, $attributes = []): HtmlStyleElement;
}
