<?php

namespace Cobra\Database\Field;

use Cobra\Database\Field\DatabaseField;

/**
 * Database INT Field
 *
 * @category  Database
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class DatabaseIntField extends DatabaseField
{
    /**
     * Database field type
     *
     * @var string
     */
    protected $type = 'INT';

    /**
     * Database field length
     *
     * @var string|int
     */
    protected $length = 11;
}
