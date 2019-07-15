<?php

namespace Cobra\Config\Cache;

use Cobra\Cache\Cache;

/**
 * Config Cache
 *
 * Interacts with the config cache to store and retrieve configuration values
 *
 * @category  Config
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class ConfigCache extends Cache
{
    /**
     * Cache sub directory
     *
     * @var string
     */
    protected $directory = 'config';

    /**
     * Cache file extension
     *
     * @var string
     */
    protected $extension = 'yml';
}
