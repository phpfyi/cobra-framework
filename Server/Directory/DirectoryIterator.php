<?php

namespace Cobra\Server\Directory;

use RegexIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RecursiveRegexIterator;
use Cobra\Container\Traits\Resolvable;
use Cobra\Interfaces\Server\Directory\DirectoryIteratorInterface;

/**
 * Directory Iterator
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
class DirectoryIterator extends \DirectoryIterator implements DirectoryIteratorInterface
{
    use Resolvable;

    /**
     * Matches all files by a given pattern
     *
     * @param  string $path
     * @param  string $pattern
     * @return array
     */
    public static function match(string $path, string $pattern): array
    {
        return array_keys(
            iterator_to_array(
                new RegexIterator(
                    new RecursiveIteratorIterator(
                        new RecursiveDirectoryIterator(ROOT.$path)
                    ),
                    $pattern,
                    RecursiveRegexIterator::GET_MATCH
                )
            )
        );
    }
}
