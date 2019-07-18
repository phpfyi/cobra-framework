<?php

namespace Cobra\View\Loader;

use Cobra\Interfaces\View\Loader\ViewScopedLoaderInterface;

/**
 * View Scoped Loader
 *
 * Loads a template with only the data in scope available to it.
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
class ViewScopedLoader implements ViewScopedLoaderInterface
{
    /**
     * Includes a template with optinal data scoped to the template.
     *
     * @param string $template
     * @param object|null $data
     * @return string
     */
    public static function output(string $template, $data = null): string
    {
        $loader = static function (string $template) use ($data) {
            include $template;
        };
        ob_start();
        $loader($template);
        $output = ob_get_contents();
        ob_end_clean();

        return (string) $output;
    }
}
