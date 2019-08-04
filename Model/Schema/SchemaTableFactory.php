<?php

namespace Cobra\Model\Schema;

use Cobra\Model\ModelDatabaseTable;
use Cobra\Model\Model;
use Cobra\Object\AbstractObject;

/**
 * Schema Table Factory
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
class SchemaTableFactory extends AbstractObject
{
    /**
     * ModelDatabaseTable instance
     *
     * @var ModelDatabaseTable
     */
    protected $databaseTable;

    /**
     * AbstractObject instance
     *
     * @var AbstractObject
     */
    protected $schema;

    /**
     * Sets the required properties
     *
     * @param ModelDatabaseTable $databaseTable
     */
    public function __construct(ModelDatabaseTable $databaseTable)
    {
        $this->databaseTable = $databaseTable;
    }

    /**
     * Returns the database table schema.
     *
     * @return AbstractObject
     */
    public function getSchema(): AbstractObject
    {
        $this->schema = $this->databaseTable->getDatabaseSchema();

        $this->schema->hierarchy = [];
        $this->schema->polymorphic = false;

        $this
            ->setHierarchy()
            ->set('getColumns', 'columns')
            ->set('getHasOneRelations', 'hasOne')
            ->set('getHasManyRelations', 'hasMany')
            ->set('getManyManyRelations', 'manyMany')
            ->set('getBelongsManyManyRelations', 'belongsManyMany');
            
        return $this->schema;
    }

    /**
     * Sets the database table hierarchy.
     *
     * @return SchemaTableFactory
     */
    protected function setHierarchy(): SchemaTableFactory
    {
        $this->schema->hierarchy[] = $namespace = $this->databaseTable->getClass();
        
        while ($namespace = get_parent_class($namespace)) {
            if (is_subclass_of($namespace, Model::class)) {
                $this->schema->hierarchy[] = $namespace;
            }
        }
        if (count($this->schema->hierarchy) > 1) {
            $this->schema->polymorphic = true;
        }
        return $this;
    }

    /**
     * Sets a database table columns or relation mapping.
     *
     * @param string $method
     * @param string $property
     * @return SchemaTableFactory
     */
    protected function set(string $method, string $property): SchemaTableFactory
    {
        $columns = $this->databaseTable->{$method}();
        array_map(
            function ($name, $column) use ($property) {
                $this->schema->{$property}[$name] = $column->getDatabaseSchema();
            },
            array_keys($columns),
            $columns
        );
        return $this;
    }
}
