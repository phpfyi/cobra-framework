<?php

namespace Cobra\Database\Traits;

use Cobra\Object\AbstractObject;

/**
 * Database Schema Trait
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
trait DatabaseSchema
{
    /**
     * Returns an object representation of the schema.
     *
     * @return AbstractObject
     */
    public function getDatabaseSchema(): AbstractObject
    {
        $schema = AbstractObject::resolve();
        array_map(
            function ($property) use (&$schema) {
                $schema->{$property} = $this->{$property};
            },
            array_keys(get_object_vars($this))
        );
        return $schema;
    }
}
