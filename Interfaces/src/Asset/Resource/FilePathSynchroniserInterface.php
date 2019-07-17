<?php

namespace Cobra\Interfaces\Asset\Resource;

/**
 * File Path Synchroniser Interface
 *
 * @category  Asset
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
interface FilePathSynchroniserInterface
{
    /**
     * Synchronises a file to its place in the file system.
     *
     * @return void
     */
    public function sync(): void;
}
