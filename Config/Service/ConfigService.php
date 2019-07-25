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
        $store = YAMLConfigStore::resolve(
            YAMLConfigCompiler::resolve()->compile()
        );

        contain_object(
            \Cobra\Interfaces\Config\ConfigInterface::class,
            \Cobra\Config\Config::instance()::setStore($store)
        );
    }
}
