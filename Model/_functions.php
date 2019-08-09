<?php

use Cobra\Environment\Environment;
use Cobra\Interfaces\Model\ModelInterface;
use Cobra\Model\ModelDatabaseTable;
use Cobra\Model\Schema\Schema;

/**
 * Model function sets
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

if (! function_exists('database_table')) {
    /**
     * Returns a database object
     *
     * @param  string|ModelInterface $value
     * @return ModelDatabaseTable
     */
    function database_table($value): ModelDatabaseTable
    {
        $class = $value instanceof ModelInterface ? $value : singleton($value);
        
        return $class->databaseTable(ModelDatabaseTable::resolve($class));
    }
}

if (! function_exists('schema')) {
    /**
     * Returns a model schema object
     *
     * @param  string|ModelInterface $item
     * @return Schema
     */
    function schema($item): Schema
    {
        $namespace = $item instanceof ModelInterface ? get_class($item) : $item;

        static $schema = [];

        if (!array_key_exists($namespace, $schema)) {
            $schema[$namespace] = container_resolve(Schema::class, [$namespace]);
        }
        return $schema[$namespace];
    }
}
