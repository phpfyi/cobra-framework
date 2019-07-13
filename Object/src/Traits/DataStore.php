<?php

namespace Cobra\Object\Traits;

/**
 * Data Store trait
 *
 * @category  Object
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
trait DataStore
{
    /**
     * Array of data values
     *
     * @var array
     */
    protected $data = [];

    /**
     * Sets a data value.
     *
     * @param  string $name
     * @param  mixed  $value
     * @return object
     */
    public function set(string $name, $value): object
    {
        $this->data[$name] = $value;
        return $this;
    }

    /**
     * Returns a data value.

     * @param  string $name
     * @param  boolean $strict
     * @return mixed
     */
    public function get(string $name, bool $strict = true)
    {
        return $strict ? $this->data[$name] : array_key($name, $this->data);
    }

    /**
     * Sets the data array.
     *
     * @param array $data
     * @return object
     */
    public function setData(array $data): object
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Returns the data array.
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}