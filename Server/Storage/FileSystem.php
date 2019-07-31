<?php

namespace Cobra\Server\Storage;

use SplFileInfo;
use Cobra\Interfaces\Server\Storage\FileSystemInterface;

/**
 * File System
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
abstract class FileSystem implements FileSystemInterface
{
    /**
     * Returns a file.
     *
     * @param string $path
     * @return string
     */
    abstract public function get(string $path): string;

    /**
     * Creates a file on the system.
     *
     * @param string $path
     * @param mixed $content
     * @return boolean
     */
    abstract public function put(string $path, $content): bool;
    
    /**
     * Removes a file from the system
     *
     * @param string $path
     * @return boolean
     */
    abstract public function remove(string $path): bool;

    /**
     * Moves a file on the system.
     *
     * @param string $fromPath
     * @param string $toPath
     * @return boolean
     */
    abstract public function move(string $fromPath, string $toPath): bool;

    /**
     * Returns the modified time of a file.
     *
     * @param string $path
     * @return integer
     */
    abstract public function modified(string $path): int;

    /**
     * Returns the size of a file on the system.
     *
     * @param string $path
     * @return integer
     */
    abstract public function size(string $path): int;

    /**
     * Creates a new directory on the system.
     *
     * @param string $path
     * @return boolean
     */
    abstract public function createDirectory(string $path): bool;

    /**
     * Removes a directory on the system.
     *
     * @param string $path
     * @return boolean
     */
    abstract public function removeDirectory(string $path): bool;

    /**
     * Checks if a file exists on the system
     *
     * @param string $path
     * @return boolean
     */
    public function exists(string $path): bool
    {
        return (new SplFileInfo($path))->isFile();
    }

    /**
     * Returns the extension of a file
     *
     * @param string $path
     * @return string
     */
    public function extension(string $path): string
    {
        return (new SplFileInfo($path))->getExtension();
    }

    /**
     * Returns the basename of a file.
     *
     * @param string $path
     * @return string
     */
    public function basename(string $path): string
    {
        return (new SplFileInfo($path))->getFilename();
    }

    /**
     * Checks a directory exists on the system.
     *
     * @param string $path
     * @return boolean
     */
    public function directoryExists(string $path): bool
    {
        return (new SplFileInfo($path))->isDir();
    }
}
