<?php

namespace Cobra\View\Loader;

use Cobra\Interfaces\View\Loader\ScopedLoaderInterface;
use Cobra\Interfaces\View\ViewDataInterface;

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
class ScopedLoader implements ScopedLoaderInterface
{
    /**
     * Includes a template with optinal data scoped to the template.
     *
     * @param string $template
     * @param ViewDataInterface|null $data
     * @return string
     */
    public static function output(string $template, ViewDataInterface $data = null): string
    {
        $vars = $data ? $data->getData() : [];

        $loader = static function (string $template) use ($vars) {
            extract($vars);
            unset($vars);
                
            include $template;
        };
        ob_start();
        $loader($template);
        $output = ob_get_contents();
        ob_end_clean();
            
        return (string) $output;
    }
}
