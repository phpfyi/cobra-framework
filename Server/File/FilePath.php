<?php

namespace Cobra\Server\File;

use SplFileInfo;
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
    public function join(...$args): string
    {
        return $this->normalize(implode(DIRECTORY_SEPARATOR, ...$args));
    }

    /**
     * Returns an absolute system file path joined by \ with a starting \.
     *
     * @param  string[] ...$args
     * @return string
     */
    public function joinAbsolute(...$args): string
    {
        return DIRECTORY_SEPARATOR.$this->join($args);
    }

    /**
     * Returns an root system file path joined by \ with a starting \.
     *
     * @param  string[] ...$args
     * @return string
     */
    public function joinRoot(...$args): string
    {
        return ROOT.$this->join($args);
    }

    /**
     * Normalizes a path composed of either directory separators or dot syntax.
     *
     * @param  string $path
     * @return string
     */
    public function normalize(string $path): string
    {
        $path = str_replace(DIRECTORY_SEPARATOR, '.', $path);

        $directories = dir_parts($path);

        $basename = array_pop($directories);
        $basename = path_basename(array_pop($directories)).'.'.$basename;

        return implode(DIRECTORY_SEPARATOR, $directories).DIRECTORY_SEPARATOR.$basename;
    }

    /**
     * Returns the path filename / basename
     *
     * @param string $path
     * @return string
     */
    public function basename(string $path): string
    {
        return (new SplFileInfo($path))->getFilename();
    }

    /**
     * Returns the path extension.
     *
     * @param string $path
     * @return string
     */
    public function extension(string $path): string
    {
        return (new SplFileInfo($path))->getExtension();
    }
}
