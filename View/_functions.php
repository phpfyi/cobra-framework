<?php

use Cobra\Interfaces\View\Loader\ViewLoaderInterface;
use Cobra\Interfaces\View\ViewInterface;
use Cobra\View\Asset\ViewCss;
use Cobra\View\Asset\ViewMeta;
use Cobra\View\Asset\ViewJavaScript;

/**
 * View function sets
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
if (! function_exists('view')) {
    /**
     * Returns the view instance
     *
     * @return ViewInterface
     */
    function view(): ViewInterface
    {
        return container_object(ViewInterface::class);
    }
}

if (! function_exists('meta')) {
    /**
     * Returns the view Meta instance
     *
     * @return ViewMeta
     */
    function meta(): ViewMeta
    {
        return container_object(ViewInterface::class)->meta();
    }
}

if (! function_exists('css')) {
    /**
     * Returns the view CSS instance
     *
     * @return ViewCss
     */
    function css(): ViewCss
    {
        return container_object(ViewInterface::class)->css();
    }
}

if (! function_exists('js')) {
    /**
     * Returns the view JavaScript instance
     *
     * @return ViewJavaScript
     */
    function javascript(): ViewJavaScript
    {
        return container_object(ViewInterface::class)->javascript();
    }
}

if (! function_exists('template')) {
    /**
     * Outputs a template
     *
     * @return string
     */
    function template(string $template): string
    {
        return container_resolve(
            ViewLoaderInterface::class,
            [
                $template,
                view()->getData()
            ]
        )->getOutput();
    }
}

if (! function_exists('url')) {
    /**
     * Returns a link to a URL
     *
     * @param  string|null $path
     * @return string
     */
    function url(string $path = null): string
    {
        return BASE_URL_SLASH.$path;
    }
}

if (! function_exists('img')) {
    /**
     * Returns a link to an image URL
     *
     * @param  string|null $path
     * @return string
     */
    function img(string $path = null): string
    {
        return IMG.$path;
    }
}
