<?php

namespace Cobra\Server\File;

use Cobra\Interfaces\Server\File\FilePathInterface;

/**
 * File Path
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
class FilePath implements FilePathInterface
{
    /**
     * Returns a system file path joined by \.
     *
     * @param  string[] ...$args
     * @return string
     */
    public static function join(...$args): string
    {
        return self::normalize(implode(DIRECTORY_SEPARATOR, $args));
    }

    /**
     * Returns an absolute system file path joined by \ with a starting \.
     *
     * @param  string[] ...$args
     * @return string
     */
    public static function joinAbsolute(...$args): string
    {
        $path = call_user_func_array([static::class, 'join'], $args);

        return DIRECTORY_SEPARATOR.$path;
    }

    /**
     * Returns an root system file path joined by \ with a starting \.
     *
     * @param  string[] ...$args
     * @return string
     */
    public static function joinRoot(...$args): string
    {
        $path = call_user_func_array([static::class, 'join'], $args);

        return ROOT.$path;
    }

    /**
     * Normalizes a path composed of either directory separators or dot syntax.
     *
     * @param  string $path
     * @return string
     */
    public static function normalize(string $path): string
    {
        $path = str_replace(DIRECTORY_SEPARATOR, '.', $path);

        $directories = dir_parts($path);

        $basename = array_pop($directories);
        $basename = basename(array_pop($directories)).'.'.$basename;

        return implode(DIRECTORY_SEPARATOR, $directories).DIRECTORY_SEPARATOR.$basename;
    }
}
