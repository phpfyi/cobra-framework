<?php

namespace Cobra\Config\Store;

use Cobra\Interfaces\Config\Store\ConfigStoreInterface;
use Cobra\Config\Exception\ConfigValueNotFoundException;
use Cobra\Object\AbstractObject;

/**
 * Config Store
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
abstract class ConfigStore extends AbstractObject implements ConfigStoreInterface
{
    /**
     * Array of configuraiton data
     *
     * @var mixed
     */
    protected $data;

    /**
     * Array of loaded configuration
     *
     * @var array
     */
    protected $loaded = [];

    /**
     * Sets a configuration value.
     *
     * @param  string $name
     * @return mixed
     */
    abstract public function set(string $name, $value): ConfigStoreInterface;

    /**
     * Returns a configuration value.
     *
     * @param  string $name
     * @return mixed
     * @throws ConfigValueNotFoundException
     */
    abstract public function get(string $name);

    /**
     * Unsets a configuration value.
     *
     * @param  string $name
     * @return mixed
     * @throws ConfigValueNotFoundException
     */
    abstract public function unset(string $name): ConfigStoreInterface;

    /**
     * Updates a configuration value.
     *
     * @param  string $name
     * @return mixed
     * @throws ConfigValueNotFoundException
     */
    abstract public function update(string $name, $value): ConfigStoreInterface;

    /**
     * Returns all configuration data.
     *
     * @return array
     */
    public function data(): array
    {
        return $this->data;
    }

    /**
     * Returns all loaded configuration data
     *
     * @return array
     */
    public function loaded(): array
    {
        return $this->loaded;
    }
}
