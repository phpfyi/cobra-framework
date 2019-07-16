<?php

namespace Cobra\Autoloader\Cache;

use Cobra\Cache\Cache;

/**
 * Autoloader Cache
 *
 * Interacts with the autoloader cache to store and retrieve class maps.
 *
 * @category  Autoloader
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class AutoloaderCache extends Cache
{
    /**
     * Cache sub directory
     *
     * @var string
     */
    protected $directory = 'autoloader';

    /**
     * Cache file extension
     *
     * @var string
     */
    protected $extension = 'json';
}
