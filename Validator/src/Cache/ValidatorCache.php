<?php

namespace Cobra\Validator\Cache;

use Cobra\Cache\Cache;

/**
 * Validator Cache
 *
 * Interacts with the validator cache to retrive a validator classmap
 *
 * @category  Validator
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class ValidatorCache extends Cache
{
    /**
     * Cache sub directory
     *
     * @var string
     */
    protected $directory = 'validator';

    /**
     * Cache file extension
     *
     * @var string
     */
    protected $extension = 'json';
}
