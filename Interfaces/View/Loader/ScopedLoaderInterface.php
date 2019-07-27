<?php

namespace Cobra\Interfaces\View\Loader;

use Cobra\Interfaces\View\ViewDataInterface;

/**
 * View Scoped Loader Interface
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
interface ScopedLoaderInterface
{
    /**
     * Includes a template with optinal data scoped to the template.
     *
     * @param string $template
     * @param ViewDataInterface $data
     * @return string
     */
    public static function output(string $template, ViewDataInterface $data = null): string;
}
