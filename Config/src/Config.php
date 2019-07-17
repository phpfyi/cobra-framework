<?php

namespace Cobra\Config;

use Cobra\Interfaces\Config\ConfigInterface;
use Cobra\Interfaces\Config\Store\ConfigStoreInterface;
use Cobra\Interfaces\Object\SingletonInterface;
use Cobra\Object\Traits\SingletonMethods;

/**
 * Config
 *
 * Main configuration singleton class
 *
 * Proxy to a config store
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
class Config implements ConfigInterface, SingletonInterface
{
    use SingletonMethods;

    /**
     * Instance of self
     *
     * @var ConfigInterface
     */
    private static $instance;

    /**
     * ConfigStoreInterface instance
     *
     * @var ConfigStoreInterface
     */
    private static $store;

    /**
     * Creates a singleton instance of this class
     *
     * @return ConfigInterface
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * Returns the config store
     *
     * @param ConfigStoreInterface
     * @return ConfigInterface
     */
    public static function setStore(ConfigStoreInterface $store): ConfigInterface
    {
        self::$store = $store;
        return self::$instance;
    }

    /**
     * Returns the config store
     *
     * @return ConfigStoreInterface
     */
    public static function getStore(): ConfigStoreInterface
    {
        return self::$store;
    }
    
    /**
     * Procy method to call store methods
     *
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public static function __callStatic(string $name, array $args)
    {
        return self::$store->{$name}(...$args);
    }
}
