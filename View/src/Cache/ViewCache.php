<?php

namespace Cobra\View\Cache;

use Cobra\Cache\Cache;

/**
 * View Cache
 *
 * Interacts with the view cache to store and retrieve view templates.
 *
 * @category  View
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class ViewCache extends Cache
{
    /**
     * Cache sub directory
     *
     * @var string
     */
    protected $directory = 'template';

    /**
     * Cache file extension
     *
     * @var string
     */
    protected $extension = TEMPLATE_EXTENSION;
}
