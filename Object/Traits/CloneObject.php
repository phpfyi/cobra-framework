<?php

namespace Cobra\Object\Traits;

/**
 * Clone Object trait
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
trait CloneObject
{
    /**
     * Clones the current instance and assigns a property
     *
     * @param  string $property
     * @param  mixed  $value
     * @return object
     */
    protected function cloneWithProperty(string $property, $value): object
    {
        $clone = clone $this;
        $clone->$property = $value;
        return $clone;
    }

    /**
     * Clones the current instance and assigns properties
     *
     * @param array $properties
     * @return object
     */
    protected function cloneWithProperties(array $properties): object
    {
        $clone = clone $this;
        array_map(function (string $key, $value) use ($clone) {
            $clone->$key = $value;
        }, array_keys($properties), $properties);
        return $clone;
    }
}
