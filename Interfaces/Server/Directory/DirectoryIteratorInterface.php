<?php

namespace Cobra\Interfaces\Server\Directory;

/**
 * Directory Iterator Interface
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
interface DirectoryIteratorInterface
{
    /**
     * Matches all files by a given pattern
     *
     * @param  string $path
     * @param  string $pattern
     * @return array
     */
    public static function match(string $path, string $pattern): array;
}
