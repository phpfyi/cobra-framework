<?php

namespace Cobra\Server\Storage;

use Closure;
use SplFileInfo;
use SplFileObject;
use Cobra\Server\Directory\DirectoryIterator;
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
class LocalFileSystem extends FileSystem
{
    /**
     * Returns a file.
     *
     * @param string $path
     * @return string
     */
    public function get(string $path): string
    {
        return $this->validate($path, function ($path) {
            $file = new SplFileObject($path, 'r');
            
            return $file->getSize() > 0 ? $file->fread($file->getSize()) : '';
        });
    }

    /**
     * Creates a file on the system.
     *
     * @param string $path
     * @param mixed $content
     * @return boolean
     */
    public function put(string $path, $content): bool
    {
        return file_put_contents($path, $content) === false ? false : true;
    }
    
    /**
     * Removes a file from the system
     *
     * @param string $path
     * @return boolean
     */
    public function remove(string $path): bool
    {
        return $this->validate($path, function ($path) {
            return unlink($path);
        });
    }

    /**
     * Moves a file on the system.
     *
     * @param string $fromPath
     * @param string $toPath
     * @return boolean
     */
    public function move(string $fromPath, string $toPath): bool
    {
        return $this->validate($fromPath, function ($fromPath) use ($toPath) {
            return rename($fromPath, $toPath);
        });
    }

    /**
     * Returns the modified time of a file.
     *
     * @param string $path
     * @return integer
     */
    public function modified(string $path): int
    {
        return $this->validate($path, function ($path) {
            return (int) (new SplFileInfo($path))->getMTime();
        });
    }

    /**
     * Returns the size of a file on the system.
     *
     * @param string $path
     * @return integer
     */
    public function size(string $path): int
    {
        return $this->validate($path, function ($path) {
            return (int) (new SplFileInfo($path))->getSize();
        });
    }
    
    /**
     * Creates a new directory on the system.
     *
     * @param string $path
     * @return boolean
     */
    public function createDirectory(string $path): bool
    {
        return !$this->directoryExists($path) ? mkdir($path) : false;
    }

    /**
     * Removes a directory on the system.
     *
     * @param string $path
     * @return boolean
     */
    public function removeDirectory(string $path): bool
    {
        if (!$this->directoryExists($path)) {
            return false;
        }
        foreach (container_resolve(DirectoryIterator::class, [$path]) as $item) {
            if (!$item->isDot()) {
                if ($item->isDir()) {
                    $this->removeDirectory($item->getPathname());
                }
                if ($item->isFile()) {
                    $this->remove($item->getPathname());
                }
            }
        }
        return rmdir($path);
    }

    /**
     * Validates a file exists
     *
     * @param string $path
     * @return mixed
     */
    protected function validate(string $path, Closure $callback)
    {
        if (!$this->exists($path)) {
            throw new MissingFileException(
                sprintf('Cannot find file: %s', $path)
            );
        }
        return $callback($path);
    }
}
