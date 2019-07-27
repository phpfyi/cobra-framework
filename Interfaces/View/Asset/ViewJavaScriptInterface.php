<?php

namespace Cobra\Interfaces\View\Asset;

use Cobra\Html\HtmlScriptElement;

/**
 * View JavaScript Interface
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
interface ViewJavaScriptInterface
{
    /**
     * Sets an inline script HTML tag
     *
     * @param  string $path
     * @param  array  $attributes
     * @return HtmlScriptElement
     */
    public function setInline(string $path, $attributes = []): HtmlScriptElement;

    /**
     * Sets a JavaScript file HTML tag
     *
     * @param  string $src
     * @param  array  $attributes
     * @return HtmlScriptElement
     */
    public function setFile(string $src, $attributes = []): HtmlScriptElement;

    /**
     * Sets a JavaScript bundle file with cache busting
     *
     * @param  string $path
     * @return HtmlScriptElement
     */
    public function setBundle(string $path): HtmlScriptElement;
}
