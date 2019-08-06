<?php

namespace Cobra\Model\Schema;

use stdClass;
use Cobra\Object\AbstractObject;

/**
 * Schema Transformer
 *
 * Constructs a schema data object from another set of schema objects.
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
class SchemaTransformer extends AbstractObject
{
    /**
     * Object to assign data to.
     *
     * @var object
     */
    protected $data;

    /**
     * Base schema class instance
     *
     * @var object
     */
    protected $baseClass;

    /**
     * Array of all parent classes
     *
     * @var array
     */
    protected $parentClasses = [];

    /**
     * Array of all hierarchy classes
     *
     * @var array
     */
    protected $classes = [];

    /**
     * Properties to copy from the base class
     *
     * @var array
     */
    protected $baseProperties = [
        'table',
        'class',
        'engine',
        'charset',
        'hierarchy',
        'polymorphic'
    ];

    /**
     * Sets the required properties
     *
     * @param array $hierarchy
     */
    public function __construct(array $hierarchy)
    {
        $this->data = new stdClass;
        $this->baseClass = array_shift($hierarchy);
        $this->parentClasses = $hierarchy;

        $this->classes = array_merge(
            [
                $this->baseClass
            ],
            $this->parentClasses
        );
    }

    /**
     * Returns the prototype data object.
     *
     * @return object
     */
    public function getData(): object
    {
        array_map(
            function (string $name) {
                $this->data->{$name} = $this->baseClass->{$name};
            },
            $this->baseProperties
        );

        $this
            ->set('columns')
            ->set('hasOne')
            ->set('hasMany')
            ->set('manyMany')
            ->set('belongsManyMany');

        return $this->data;
    }

    /**
     * Sets the base data properties.
     *
     * @param string $properties
     * @return SchemaTransformer
     */
    protected function set(string $properties): SchemaTransformer
    {
        $this->data->{$properties} = [];

        $this->setProperties($properties);

        return $this;
    }

    /**
     * Sets a grouping of properites.
     *
     * @param string $properties
     * @return SchemaTransformer
     */
    protected function setProperties(string $properties): SchemaTransformer
    {
        array_map(function (object $class) use ($properties) {
            $this->data->{$properties} = array_merge(
                $this->data->{$properties},
                $this->getObjectProperties($class, $properties)
            );
            ;
        }, $this->classes);

        return $this;
    }

    /**
     * Returns a grouping of object properties.
     *
     * @param object $baseObject
     * @param string $properties
     * @return array
     */
    protected function getObjectProperties(object $baseObject, string $properties): array
    {
        return array_combine(
            array_keys($baseObject->{$properties}),
            array_map(
                function (object $object) use ($baseObject) {
                    $object->ownerTable = $baseObject->table;
                    $object->ownerClass = $baseObject->class;
        
                    return $object;
                },
                $baseObject->{$properties}
            )
        );
    }
}
