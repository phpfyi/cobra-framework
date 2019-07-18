<?php

namespace Cobra\Interfaces\Environment;

/**
 * Environment Data Interface
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
interface EnvironmentDataInterface
{
    /**
     * Loads the environment data and returns it as an array.
     *
     * @throws MissingEnvironmentFileException
     * @return array
     */
    public function load(): array;
}
