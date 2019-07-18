<?php

namespace Cobra\Interfaces\Environment;

/**
 * Environment Interface
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
interface EnvironmentInterface
{
    /**
     * Sets up the environment singleton instance
     *
     * @return EnvironmentInterface
     */
    public static function instance(): EnvironmentInterface;

    /**
     * Returns an environment value.
     *
     * @param  string $name
     * @return mixed
     * @throws InvalidEnvironmentVarException
     */
    public static function get(string $name);

    /**
     * Returns all environment values.
     *
     * @return array
     */
    public static function data(): array;
}
