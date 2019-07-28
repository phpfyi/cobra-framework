<?php

use Cobra\Object\AbstractObject;

/**
 * Object function sets
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

if (! function_exists('singleton')) {
    /**
     * Sets and returns a singleton object
     *
     * @param  string $namespace
     * @return Object
     */
    function singleton(string $namespace): AbstractObject
    {
        static $classes = [];

        if (!array_key_exists($namespace, $classes)) {
            $classes[$namespace] = $namespace::resolve();
        }
        return $classes[$namespace];
    }
}

if (! function_exists('object_assign')) {
    /**
     * Assigns the properties from one object to another
     *
     * @param  AbstractObject $data
     * @param  stdClass       $data
     * @return ObjectMapInterface
     */
    function object_assign(AbstractObject $object, stdClass $data): AbstractObject
    {
        $source = new ReflectionObject($data);
        array_map(
            function ($property) use ($object, $data) {
                $name = $property->getName();
                $object->{$name} = $data->{$name};
            },
            $source->getProperties()
        );
        return $object;
    }
}

if (! function_exists('object_clone')) {
    /**
     * Returns a clone of an object with new properties
     *
     * @param object $object
     * @param array $properties
     * @return object
     */
    function object_clone(object $object, array $properties = []): object
    {
        $clone = clone $object;
        array_map(function (string $key, $value) use ($clone) {
            $clone->$key = $value;
        }, array_keys($properties), $properties);
        return $clone;
    }
}

if (! function_exists('short_name')) {
    /**
     * Returns the class short name
     *
     * @param string $namespace
     * @return string
     */
    function short_name(string $namespace): string
    {
        return (new ReflectionClass($namespace))->getShortName();
    }
}
