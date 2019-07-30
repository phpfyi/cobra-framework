<?php

namespace Cobra\Environment;

use Cobra\Environment\EnvironmentData;
use Cobra\Environment\Exception\InvalidEnvironmentVarException;
use Cobra\Interfaces\Environment\EnvironmentInterface;
use Cobra\Interfaces\Object\SingletonInterface;
use Cobra\Object\Traits\SingletonMethods;

/**
 * Environment
 *
 * Loads and contains the immutable framework environment data.
 *
 * Singleton data store that should be initalised as early as possible using
 * the instance() method to set it up.
 *
 * This class does not actually pass any data up to the server through setenv()
 * or similar but instead pulls the available server data and merges it into
 * the environment file data.
 *
 * @category  Environment
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
final class Environment implements EnvironmentInterface, SingletonInterface
{
    use SingletonMethods;

    /**
     * Environment data instance
     *
     * @var array
     */
    private static $data = [];

    /**
     * Sets up the environment singleton instance
     *
     * @return EnvironmentInterface
     */
    public static function instance(): EnvironmentInterface
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new static();

            self::$data = container_resolve(
                EnvironmentData::class, [ENVIRONMENT_FILE]
            )->load();
        }
        return $instance;
    }

    /**
     * Returns an environment value.
     *
     * @param  string $name
     * @return mixed
     * @throws InvalidEnvironmentVarException
     */
    public static function get(string $name)
    {
        if (!array_key_exists($name, self::$data)) {
            throw new InvalidEnvironmentVarException(
                sprintf('No %s value found in environment config', $name)
            );
        }
        return self::$data[$name];
    }

    /**
     * Returns all environment values.
     *
     * @return array
     */
    public static function data(): array
    {
        return self::$data;
    }
}
