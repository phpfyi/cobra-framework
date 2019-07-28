<?php

namespace Cobra\Config\Service;

use Cobra\Core\Service\Service;
use Cobra\Config\Compiler\YAMLConfigCompiler;
use Cobra\Config\Store\YAMLConfigStore;

/**
 * Config Service
 *
 * @category  Config
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class ConfigService extends Service
{
    /**
     * Set up any service class instances required by the application.
     *
     * @return void
     */
    public function instances(): void
    {
        $this
            ->instance(
                \Cobra\Interfaces\Config\ConfigInterface::class,
                \Cobra\Config\Config::class
            );

        $store = container_resolve(
            YAMLConfigStore::class,
            [
                container_resolve(YAMLConfigCompiler::class)->compile()
            ]
        );

        container_object(
            \Cobra\Interfaces\Config\ConfigInterface::class
        )->setStore($store);
    }
}
