<?php

namespace Cobra\Interfaces\View;

use Cobra\Interfaces\View\Asset\ViewCssInterface;
use Cobra\Interfaces\View\Asset\ViewMetaInterface;
use Cobra\Interfaces\View\Asset\ViewJavaScriptInterface;

/**
 * View interface
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
interface ViewInterface
{
    /**
     * Sets the view page data property
     *
     * @param  string $page
     * @return ViewInterface
     */
    public function setPage(string $page): ViewInterface;

    /**
     * Sets a view data property
     *
     * @param  string $name
     * @param  mixed  $value
     * @return ViewInterface
     */
    public function setData(string $name, $value): ViewInterface;

    /**
     * Returns the view data instance
     *
     * @return ViewDataInterface
     */
    public function getData(): ViewDataInterface;

    /**
     * Returns the Meta instance
     *
     * @return ViewMetaInterface
     */
    public function meta(): ViewMetaInterface;

    /**
     * Returns the CSS instance
     *
     * @return ViewCssInterface
     */
    public function css(): ViewCssInterface;

    /**
     * Returns the JavaScript instance
     *
     * @return ViewJavaScriptInterface
     */
    public function javascript(): ViewJavaScriptInterface;
}
