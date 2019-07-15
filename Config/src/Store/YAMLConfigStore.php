<?php

namespace Cobra\Config\Store;

use Closure;
use Cobra\Config\Exception\ConfigValueNotFoundException;
use Cobra\Interfaces\Config\Store\ConfigStoreInterface;

/**
 * YAML Config Store
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
class YAMLConfigStore extends ConfigStore
{
    /**
     * Array of configuraiton data
     *
     * @var array
     */
    protected $data = [];

    /**
     * Sets the required array data from parsed YAML data.
     *
     * @param string $data
     */
    public function __construct(string $data)
    {
        $this->data = yaml_parse($data);
    }

    /**
     * Sets a configuration value.
     *
     * @param  string $name
     * @return mixed
     * @throws ConfigValueNotFoundException
     */
    public function set(string $name, $value): ConfigStoreInterface
    {
        $this->find($name, function (&$data, string $segment) use ($value) {
            $data[$segment] = $value;
        }, true);
        return $this;
    }

    /**
     * Returns a configuration value.
     *
     * @param  string $name
     * @return mixed
     * @throws ConfigValueNotFoundException
     */
    public function get(string $name)
    {
        return $this->find($name, function (&$data, string $segment) use ($name) {
            return $this->loaded[$name] = $data[$segment];
        });
    }
    
    /**
     * Unsets a configuration value.
     *
     * @param  string $name
     * @return mixed
     * @throws ConfigValueNotFoundException
     */
    public function unset(string $name): ConfigStoreInterface
    {
        $this->find($name, function (&$data, string $segment) {
            unset($data[$segment]);
        });
        return $this;
    }

    /**
     * Updates a configuration value.
     *
     * @param  string $name
     * @return mixed
     * @throws ConfigValueNotFoundException
     */
    public function update(string $name, $value): ConfigStoreInterface
    {
        $this->find($name, function (&$data, string $segment) use ($value) {
            $data[$segment] = $value;
        });
        return $this;
    }

    /**
     * Finds an config value by traversing through the array keys of the config
     * array and optionally sets missing keys or throws an error.
     *
     * @param string $name
     * @param Closure $callback
     * @param boolean $set
     * @return mixed
     * @throws ConfigValueNotFoundException
     */
    protected function find(string $name, Closure $callback, bool $set = false)
    {
        $data = &$this->data;
        $segments = explode('.', $name);

        foreach ($segments as $i => $segment) {
            if (!array_key_exists($segment, $data)) {
                if ($set === true) {
                    $data[$segment] = null;
                } else {
                    throw new ConfigValueNotFoundException(
                        sprintf('No config value found for: %s', $name)
                    );
                }
            }
            if ($i === array_key_last($segments)) {
                return $callback($data, $segment);
            }
            $data = &$data[$segment];
        }
        return $this;
    }
}
