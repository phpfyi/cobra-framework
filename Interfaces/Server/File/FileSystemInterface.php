<?php

namespace Cobra\Interfaces\Server\File;

/**
 * File System Interface
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
interface FileSystemInterface
{
    /**
     * Returns a file contents
     *
     * @param  string $path
     * @return void
     * @throws MissingFileException
     */
    public static function get(string $path);

    /**
     * Sends content to a file
     *
     * @param  string $path
     * @return boolean
     */
    public static function put(string $path, $content): bool;

    /**
     * Returns whether the file exists and is a file
     *
     * @param  string $path
     * @return boolean
     */
    public static function exists(string $path): bool;
    
    /**
     * Removes a file off a dot notation or directory separator syntax
     *
     * @param  string $path
     * @return boolean
     * @throws MissingFileException
     */
    public static function remove(string $path): bool;

    /**
     * Moves a files resource
     *
     * @param  string $fromPath
     * @param  string $toPath
     * @return boolean
     * @throws MissingFileException
     */
    public static function move(string $fromPath, string $toPath): bool;

    /**
     * Returns the file modified time.
     *
     * @param string $path
     * @return int
     */
    public static function modified(string $path): int;
}
