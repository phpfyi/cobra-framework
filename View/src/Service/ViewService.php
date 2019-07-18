<?php

namespace Cobra\View\Service;

use Cobra\Core\Service\Service;

/**
 * View Service
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
class ViewService extends Service
{
    /**
     * Bind namespace references to classes in the container.
     *
     * @return void
     */
    public function namespaces(): void
    {
        contain_namespace(
            \Cobra\Interfaces\View\Loader\ViewLoaderInterface::class,
            \Cobra\View\Loader\ViewLoader::class
        );
        contain_namespace(
            \Cobra\Interfaces\View\Loader\ViewScopedLoaderInterface::class,
            \Cobra\View\Loader\ViewScopedLoader::class
        );
        contain_namespace(
            \Cobra\Interfaces\View\Transform\ViewParserInterface::class,
            \Cobra\View\Transform\ViewParser::class
        );
        contain_namespace(
            \Cobra\Interfaces\View\Transform\ViewMinifierInterface::class,
            \Cobra\View\Transform\ViewParser::class
        );
    }
}
