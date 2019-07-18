<?php

namespace Cobra\Interfaces\View\Loader;

/**
 * View Loader Interface
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
interface ViewLoaderInterface
{
    /**
     * Checks the cache for a template and returns it if found.
     *
     * If not found then the template is created and sent to the cache;
     *
     * @return string
     */
    public function getOutput(): string;
}
