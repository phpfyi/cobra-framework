<?php

namespace Cobra\Server\Directory;

use SplFileInfo;
use Cobra\Interfaces\Server\Directory\DirectoryInterface;
use Cobra\Server\Directory\DirectoryIterator;

/**
 * Directory
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
class Directory implements DirectoryInterface
{
    /**
     * Returns a path to a file directory off a dot notation or directory
     * separator syntax
     *
     * @param  string[] ...$args
     * @return string
     */
    public static function path(...$args): string
    {
        $parts = [];
        array_map(
            function ($arg) use (&$parts) {
                $parts = array_merge(
                    $parts,
                    dir_parts($arg)
                );
            },
            $args
        );
        $path = implode(DIRECTORY_SEPARATOR, $parts);
        $path = implode(
            DIRECTORY_SEPARATOR,
            array_filter(explode(DIRECTORY_SEPARATOR, $path))
        );

        return ROOT.$path.DIRECTORY_SEPARATOR;
    }

    /**
     * Create a system directory off a dot notation or directory
     * separator syntax
     *
     * @param  string[] ...$args
     * @return boolean|null
     */
    public static function create(...$args):? bool
    {
        $path = container_resolve(DirectoryInterface::class)->path(...$args);
        
        return !container_resolve(DirectoryInterface::class)->isDir($path) ? mkdir($path) : null;
    }
    
    /**
     * Removes a system directory off a dot notation or directory
     * separator syntax
     *
     * @param  string[] ...$args
     * @return boolean
     */
    public static function remove(...$args): bool
    {
        $path = container_resolve(DirectoryInterface::class)->path(...$args);

        if (!container_resolve(DirectoryInterface::class)->isDir($path)) {
            return false;
        }

        foreach (DirectoryIterator::resolve($path) as $item) {
            if ($item->isDot()) {
                continue;
            }
            if ($item->isDir()) {
                self::remove($item->getPathname());
            }
            if ($item->isFile()) {
                unlink($item->getPathname());
            }
        }
        return rmdir($path);
    }

    /**
     * Returns if the given path is a directory.
     *
     * @param string $path
     * @return boolean
     */
    public static function isDir(string $path): bool
    {
        return (new SplFileInfo($path))->isDir();
    }
}
