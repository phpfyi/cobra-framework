<?php

/**
 * Core function set
 *
 * @category  Core
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */

if (! function_exists('array_combine_from')) {
    /**
     * Returns an assoc array from a normal array
     *
     * @param  array $array
     * @return array
     */
    function array_combine_from(array $array): array
    {
        return array_combine($array, $array);
    }
}

if (! function_exists('array_from')) {
    /**
     * Returns an array from a single value
     *
     * @param  mixed $value
     * @return array
     */
    function array_from($value): array
    {
        return is_array($value) ? $value : [$value];
    }
}

if (! function_exists('array_key')) {
    /**
     * Searches for an array value by key or returns the default value
     *
     * @param  string $key
     * @param  array  $array
     * @param  mixed  $default
     * @return mixed
     */
    function array_key(string $key, array $array, $default = null)
    {
        return array_key_exists($key, $array) ? $array[$key] : $default;
    }
}

if (! function_exists('array_key_unset')) {
    /**
     * Unsets and array key if it exists
     *
     * @param  string $key
     * @param  array  $array
     * @param  mixed  $default
     * @return mixed
     */
    function array_key_unset(string $key, array &$array): void
    {
        if (array_key_exists($key, $array)) {
            unset($array[$key]);
        }
    }
}

if (! function_exists('array_keys_unset')) {
    /**
     * Unsets an array of keys if they exists
     *
     * @param array $keys
     * @return void
     */
    function array_keys_unset(array $keys, array &$array): void
    {
        array_map(
            function ($key) use (&$array) {
                array_key_unset($key, $array);
            },
            $keys
        );
    }
}

if (! function_exists('array_strpos')) {
    /**
     * Checks the strpos of a value in an array
     *
     * @param  string $key
     * @param  array  $array
     * @param  mixed  $default
     * @return mixed
     */
    function array_strpos(array $values, ?string $search): bool
    {
        foreach ($values as $value) {
            if (strpos($search, $value) !== false) {
                return true;
            }
        }
        return false;
    }
}

if (! function_exists('arg_is_string')) {
    /**
     * Validates a string value
     *
     * @param  mixed $value
     * @return string
     * @throws InvalidArgumentException
     */
    function arg_is_string($value): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException('Invalid string value');
        }
        return $value;
    }
}

if (! function_exists('arg_is_array')) {
    /**
     * Validates a value is an array
     *
     * @param  mixed $value
     * @return array
     * @throws InvalidArgumentException
     */
    function arg_is_array($value): array
    {
        if (!is_array($value)) {
            throw new InvalidArgumentException('Invalid array value');
        }
        return $value;
    }
}

if (! function_exists('arg_is_int')) {
    /**
     * Validates a value is an integer
     *
     * @param  mixed $value
     * @return integer
     * @throws InvalidArgumentException
     */
    function arg_is_int($value): int
    {
        if (!is_int($value)) {
            throw new InvalidArgumentException('Invalid int value');
        }
        return $value;
    }
}

if (! function_exists('arg_in_array')) {
    /**
     * Validates a value is in an array
     *
     * @param  mixed $value
     * @param  array $values
     * @return mixed
     * @throws InvalidArgumentException
     */
    function arg_in_array($value, array $values)
    {
        if (!in_array($value, $values)) {
            throw new InvalidArgumentException('Invalid argument not in array');
        }
        return $value;
    }
}

if (! function_exists('arg_in_range')) {
    /**
     * Validates a value is within a numeric range
     *
     * @param  mixed   $value
     * @param  integer $min
     * @param  integer $max
     * @return integer
     * @throws InvalidArgumentException
     */
    function arg_in_range($value, int $min, int $max): int
    {
        if ($value < $min || $value > $max) {
            throw new InvalidArgumentException('Invalid range value');
        }
        return $value;
    }
}

if (! function_exists('arg_is_string_or_array')) {
    /**
     * Validates a value is a string or array
     *
     * @param  mixed $value
     * @return string|array
     * @throws InvalidArgumentException
     */
    function arg_is_string_or_array($value)
    {
        if (!is_string($value) || !is_array($value)) {
            throw new InvalidArgumentException('Value must be a string or array');
        }
        return $value;
    }
}

if (! function_exists('arg_is_instanceof')) {
    /**
     * Validates a value is an instance of a class
     *
     * @param  mixed  $value
     * @param  string $class
     * @return object
     * @throws InvalidArgumentException
     */
    function arg_is_instanceof($value, string $class): object
    {
        if (!$value instanceof $class) {
            throw new InvalidArgumentException('Invalid class instance argument');
        }
        return $value;
    }
}

if (! function_exists('args_is_instanceof')) {
    /**
     * Validates an array of values are an instance of a class
     *
     * @param  array  $values
     * @param  string $class
     * @return array
     * @throws InvalidArgumentException
     */
    function args_is_instanceof(array $values, string $class): array
    {
        array_map(
            function ($value) use ($class) {
                arg_is_instanceof($value, $class);
            },
            $values
        );
        return $values;
    }
}
