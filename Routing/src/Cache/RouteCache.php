<?php

namespace Cobra\Routing\Cache;

use Cobra\Cache\Cache;

/**
 * Route Cache
 *
 * Interacts with the route cache to store and retrieves route configuration.
 *
 * @category  Routing
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class RouteCache extends Cache
{
    /**
     * Cache sub directory
     *
     * @var string
     */
    protected $directory = 'routes';

    /**
     * Cache file extension
     *
     * @var string
     */
    protected $extension = 'yml';
}
