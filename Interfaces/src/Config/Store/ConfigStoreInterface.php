<?php

namespace Cobra\Interfaces\Config\Store;

/**
 * Config Store Interface
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
interface ConfigStoreInterface
{
    /**
     * Sets a configuration value.
     *
     * @param  string $name
     * @return mixed
     */
    public function set(string $name, $value): ConfigStoreInterface;

    /**
     * Returns a configuration value.
     *
     * @param  string $name
     * @return mixed
     * @throws ConfigValueNotFoundException
     */
    public function get(string $name);

    /**
     * Unsets a configuration value.
     *
     * @param  string $name
     * @return mixed
     * @throws ConfigValueNotFoundException
     */
    public function unset(string $name, $value): ConfigStoreInterface;

    /**
     * Updates a configuration value.
     *
     * @param  string $name
     * @return mixed
     * @throws ConfigValueNotFoundException
     */
    public function update(string $name, $value): ConfigStoreInterface;
}
