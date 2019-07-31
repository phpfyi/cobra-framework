<?php

use Cobra\Interfaces\Server\Storage\FileSystemInterface;

/**
 * Server function sets
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

if (! function_exists('b_to_kb')) {
    /**
     * Returns a Kilobyte (KB) size from a byte size
     *
     * @param  integer $size
     * @param  string  $unit
     * @return string
     */
    function b_to_kb(int $size, string $unit = 'KB'): string
    {
        return sprintf('%s%s', number_format($size / 1024, 1), $unit);
    }
}

if (! function_exists('subtract_microtime')) {
    /**
     * Calculates the differnce between 2 microtimes
     *
     * @param string $start
     * @param string $end
     * @param int $precision
     * @return string
     */
    function subtract_microtime(string $start, string $end, int $precision = 6): string
    {
        list($susec, $ssec) = explode(" ", $start);
        list($eusec, $esec) = explode(" ", $end);

        $sec = intval($esec) - intval($ssec);
        $usec = floatval($eusec) - floatval($susec);
        
        return number_format(floatval($sec) + $usec, $precision);
    }
}

if (! function_exists('memory_usage')) {
    /**
     * Returns the memory used by the system
     *
     * @return string
     */
    function memory_usage(): string
    {
        $usage = memory_get_usage(true);
        $units = ['B','KB','MB','GB','TB','PB'];
        
        return @round($usage / pow(1024, ($unit = floor(log($usage, 1024)))), 2).$units[$unit];
    }
}

if (! function_exists('dir_parts')) {
    /**
     * Returns an array of directories from a path and escapes each segment.
     *
     * @return string
     */
    function dir_parts(string $path): array
    {
        return array_map(function (string $directory) {
            return container_resolve(FileSystemInterface::class)->basename($directory);
        }, explode('.', $path));
    }
}

if (! function_exists('path_join_root')) {
    /**
     * Returns an root system file path joined by \ with a starting \.
     *
     * @param  string[] ...$args
     * @return string
     */
    function path_join_root(...$args): string
    {
        return ROOT.normalize_path(implode(DIRECTORY_SEPARATOR, $args));
    }
}

if (! function_exists('normalize_directory')) {
    /**
     * Returns a path to a file directory off a dot notation or directory
     * separator syntax
     *
     * @param string[] ...$args
     * @return string
     */
    function normalize_directory(...$args): string
    {
        return ROOT.implode(DIRECTORY_SEPARATOR, $args).DIRECTORY_SEPARATOR;
    }
}

if (! function_exists('normalize_path')) {
    /**
     * Normalizes a path composed of either directory separators or dot syntax.
     *
     * @param string $path
     * @return string
     */
    function normalize_path(string $path): string
    {
        $path = str_replace(DIRECTORY_SEPARATOR, '.', $path);

        $directories = dir_parts($path);

        $basename = array_pop($directories);
        $basename = container_resolve(FileSystemInterface::class)->basename(array_pop($directories)).'.'.$basename;

        return implode(DIRECTORY_SEPARATOR, $directories).DIRECTORY_SEPARATOR.$basename;
    }
}
