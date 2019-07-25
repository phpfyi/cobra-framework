<?php

namespace Cobra\Interfaces\Object;

/**
 * Singleton Interface
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
interface SingletonInterface
{
    /**
     * Creates a singleton instance
     *
     * @return self omitted as the return type is defined in implementing class.
     */
    public static function instance();
}
