<?php

namespace Cobra\Model\Property;

use Cobra\Model\Model;
use Cobra\Object\AbstractObject;

/**
 * Property Binder
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
class PropertyBinder extends AbstractObject
{
    /**
     * Source model instance
     *
     * @var Model
     */
    protected $source;

    /**
     * Array of columns names to bind
     *
     * @var array
     */
    protected $columns = [];

    /**
     * Properties to bind
     *
     * @var array
     */
    protected $properties = [];

    /**
     * Array of columns to skip
     *
     * @var array
     */
    protected $unassignable = [];

    /**
     * Sets the required properties
     *
     * @param Model $source
     * @param array $columns
     * @param array $properties
     * @param array $unassignable
     */
    public function __construct(Model $source, array $columns, array $properties, array $unassignable)
    {
        $this->source = $source;
        $this->columns = $columns;
        $this->properties = $properties;
        $this->unassignable = $unassignable;
    }

    /**
     * Performs the extraction operation
     *
     * @return PropertyBinder
     */
    public function doBind(): PropertyBinder
    {
        array_map(
            function (string $column) {
                $this->bindProperty($column);
            },
            $this->columns
        );
        return $this;
    }

    /**
     * Binds a property to the source model
     *
     * @param  string $property
     * @return void
     */
    protected function bindProperty(string $property): void
    {
        if (!in_array($property, $this->unassignable)) {
            if (array_key_exists($property, $this->properties)) {
                $this->source->$property = $this->properties[$property];
            }
        }
    }
}
