<?php

namespace Cobra\Server\File;

use Cobra\Interfaces\Server\File\FileSystemInterface;
use Cobra\Server\Exception\MissingFileException;
use Cobra\Server\File\FileInfo;

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
class FileSystem implements FileSystemInterface
{
    /**
     * Returns a file contents
     *
     * @param  string $path
     * @return void
     * @throws MissingFileException
     */
    public static function get(string $path)
    {
        if (!file_exists($path)) {
            throw new MissingFileException(
                sprintf('Cannot find file to get: %s', $path)
            );
        }
        return file_get_contents($path);
    }

    /**
     * Sends content to a file
     *
     * @param  string $path
     * @return boolean
     */
    public static function put(string $path, $content): bool
    {
        return file_put_contents($path, $content) === false ? false : true;
    }

    /**
     * Returns whether the file exists and is a file
     *
     * @param  string $path
     * @return boolean
     */
    public static function exists(string $path): bool
    {
        return FileInfo::resolve($path)->isFile();
    }
    
    /**
     * Removes a file off a dot notation or directory separator syntax
     *
     * @param  string $path
     * @return boolean
     * @throws MissingFileException
     */
    public static function remove(string $path): bool
    {
        if (!file_exists($path)) {
            throw new MissingFileException(
                sprintf('Cannot find file to remove: %s', $path)
            );
        }
        return unlink($path);
    }

    /**
     * Moves a files resource
     *
     * @param  string $from
     * @param  string $to
     * @return boolean
     * @throws MissingFileException
     */
    public static function move(string $from, string $to): bool
    {
        if (!file_exists($from)) {
            throw new MissingFileException(
                sprintf('Cannot find file to move: %s', $from)
            );
        }
        return rename($from, $to);
    }
}
