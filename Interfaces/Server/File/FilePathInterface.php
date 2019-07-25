<?php

namespace Cobra\Interfaces\Server\File;

/**
 * File Path Interface
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
interface FilePathInterface
{
    /**
     * Returns a system file path joined by \.
     *
     * @param  string[] ...$args
     * @return string
     */
    public static function join(...$args): string;

    /**
     * Returns an absolute system file path joined by \ with a starting \.
     *
     * @param  string[] ...$args
     * @return string
     */
    public static function joinAbsolute(...$args): string;

    /**
     * Returns an root system file path joined by \ with a starting \.
     *
     * @param  string[] ...$args
     * @return string
     */
    public static function joinRoot(...$args): string;

    /**
     * Normalizes a path composed of either directory separators or dot syntax.
     *
     * @param  string $path
     * @return string
     */
    public static function normalize(string $path): string;

    /**
     * Returns the path filename / basename
     *
     * @param string $path
     * @return string
     */
    public static function basename(string $path): string;
}
