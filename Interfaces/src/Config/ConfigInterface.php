<?php

namespace Cobra\Interfaces\Config;

use Cobra\Interfaces\Config\Store\ConfigStoreInterface;

/**
 * Config Interface
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
interface ConfigInterface
{
    /**
     * Returns the config store
     *
     * @param ConfigStoreInterface
     * @return ConfigInterface
     */
    public static function setStore(ConfigStoreInterface $store): ConfigInterface;

    /**
     * Returns the config store
     *
     * @return ConfigStoreInterface
     */
    public static function getStore(): ConfigStoreInterface;
}
