<?php

namespace Cobra\Interfaces\Server\Directory;

/**
 * Directory Interface
 *
 * @category  Server
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
interface DirectoryInterface
{
    /**
     * Returns a path to a file directory off a dot notation or directory
     * separator syntax
     *
     * @param  string[] ...$args
     * @return string
     */
    public static function path(...$args): string;

    /**
     * Create a system directory off a dot notation or directory
     * separator syntax
     *
     * @param  string[] ...$args
     * @return boolean|null
     */
    public static function create(...$args):? bool;
    
    /**
     * Removes a system directory off a dot notation or directory
     * separator syntax
     *
     * @param  string[] ...$args
     * @return boolean
     */
    public static function remove(...$args): bool;
}
