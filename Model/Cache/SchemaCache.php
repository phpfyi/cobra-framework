<?php

namespace Cobra\Model\Cache;

use Cobra\Cache\Cache;

/**
 * Schema Cache
 *
 * Interacts with the model schema cache to store and retrieve data.
 *
 * @category  Model
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class SchemaCache extends Cache
{
    /**
     * Cache sub directory
     *
     * @var string
     */
    protected $directory = 'schema';

    /**
     * Cache file extension
     *
     * @var string
     */
    protected $extension = 'json';
}
