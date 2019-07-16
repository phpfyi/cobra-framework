<?php

namespace Cobra\Autoloader\Service;

use Cobra\Core\Service\Service;

/**
 * Autoloader Service
 *
 * @category  Autoloader
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class AutoloaderService extends Service
{
    /**
     * Bind namespace references to classes in the container.
     *
     * @return void
     */
    public function namespaces(): void
    {
        contain_namespace(
            \Cobra\Interfaces\Autoloader\AutoloaderInterface::class,
            \Cobra\Autoloader\Autoloader::class
        );
    }

    /**
     * Set up any service class instances required by the application.
     *
     * @return void
     */
    public function instances(): void
    {
        contain_object(
            \Cobra\Interfaces\Autoloader\ComposerAutoloaderInterface::class,
            \Cobra\Autoloader\ComposerAutoloader::resolve($this->app->getClassLoader())
        );

        $config = static::config('aliases');
        array_map(
            function ($alias, $namespace) {
                class_alias($namespace, $alias);
            },
            array_keys($config),
            $config
        );
    }
}
