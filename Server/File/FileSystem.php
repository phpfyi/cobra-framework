<?php

namespace Cobra\Server\File;

use SplFileInfo;
use SplFileObject;
use Cobra\Interfaces\Server\File\FileSystemInterface;
use Cobra\Server\Exception\MissingFileException;

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
    public function get(string $path)
    {
        if (!$this->exists($path)) {
            throw new MissingFileException(
                sprintf('Cannot find file to get: %s', $path)
            );
        }
        $file = new SplFileObject($path, 'r');
        
        return $file->getSize() > 0 ? $file->fread($file->getSize()) : '';
    }

    /**
     * Sends content to a file
     *
     * @param  string $path
     * @return boolean
     */
    public function put(string $path, $content): bool
    {
        return file_put_contents($path, $content) === false ? false : true;
    }

    /**
     * Returns whether the file exists and is a file
     *
     * @param  string $path
     * @return boolean
     */
    public function exists(string $path): bool
    {
        return (new SplFileInfo($path))->isFile();
    }
    
    /**
     * Removes a file off a dot notation or directory separator syntax
     *
     * @param  string $path
     * @return boolean
     * @throws MissingFileException
     */
    public function remove(string $path): bool
    {
        if (!$this->exists($path)) {
            throw new MissingFileException(
                sprintf('Cannot find file to remove: %s', $path)
            );
        }
        return unlink($path);
    }

    /**
     * Moves a files resource
     *
     * @param  string $fromPath
     * @param  string $toPath
     * @return boolean
     * @throws MissingFileException
     */
    public function move(string $fromPath, string $toPath): bool
    {
        if (!$this->exists($fromPath)) {
            throw new MissingFileException(
                sprintf('Cannot find file to move: %s', $fromPath)
            );
        }
        return rename($fromPath, $toPath);
    }

    /**
     * Returns the file modified time.
     *
     * @param string $path
     * @return int
     */
    public function modified(string $path): int
    {
        return (int) (new SplFileInfo($path))->getMTime();
    }

    /**
     * Returns the file size.
     *
     * @param string $path
     * @return int
     */
    public function size(string $path): int
    {
        return (int) (new SplFileInfo($path))->getSize();
    }
}
