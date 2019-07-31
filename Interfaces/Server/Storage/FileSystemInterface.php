<?php

namespace Cobra\Interfaces\Server\Storage;

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
     * Returns a file.
     *
     * @param string $path
     * @return string
     */
    public function get(string $path): string;

    /**
     * Creates a file on the system.
     *
     * @param string $path
     * @param mixed $content
     * @return boolean
     */
    public function put(string $path, $content): bool;

    /**
     * Checks if a file exists on the system
     *
     * @param string $path
     * @return boolean
     */
    public function exists(string $path): bool;
    
    /**
     * Removes a file from the system
     *
     * @param string $path
     * @return boolean
     */
    public function remove(string $path): bool;

    /**
     * Moves a file on the system.
     *
     * @param string $fromPath
     * @param string $toPath
     * @return boolean
     */
    public function move(string $fromPath, string $toPath): bool;

    /**
     * Returns the modified time of a file.
     *
     * @param string $path
     * @return integer
     */
    public function modified(string $path): int;

    /**
     * Returns the size of a file on the system.
     *
     * @param string $path
     * @return integer
     */
    public function size(string $path): int;

    /**
     * Returns the basename of a file.
     *
     * @param string $path
     * @return string
     */
    public function basename(string $path): string;

    /**
     * Returns the extension of a file
     *
     * @param string $path
     * @return string
     */
    public function extension(string $path): string;

    /**
     * Creates a new directory on the system.
     *
     * @param string $path
     * @return boolean
     */
    public function createDirectory(string $path): bool;

    /**
     * Removes a directory on the system.
     *
     * @param string $path
     * @return boolean
     */
    public function removeDirectory(string $path): bool;

    /**
     * Checks a directory exists on the system.
     *
     * @param string $path
     * @return boolean
     */
    public function directoryExists(string $path): bool;
}
