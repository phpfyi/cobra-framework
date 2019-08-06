<?php

namespace Cobra\Model\Property;

use Cobra\Model\Model;
use Cobra\Object\AbstractObject;

/**
 * Property Extractor
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
class PropertyExtractor extends AbstractObject
{
    /**
     * Source model instance
     *
     * @var Model
     */
    protected $source;

    /**
     * Array of columns to extract
     *
     * @var array
     */
    protected $columns = [];

    /**
     * Array of columns to skip
     *
     * @var array
     */
    protected $unassignable = [];

    /**
     * Properties extracted
     *
     * @var array
     */
    protected $properties = [];

    /**
     * Sets the required properties
     *
     * @param Model $source
     * @param array $columns
     * @param array $unassignable
     */
    public function __construct(Model $source, array $columns, array $unassignable)
    {
        $this->source = $source;
        $this->columns = $columns;
        $this->unassignable = $unassignable;
    }

    /**
     * Returns the extracted properties
     *
     * @return array
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * Performs the extraction operation
     *
     * @return PropertyExtractor
     */
    public function doExtraction(): PropertyExtractor
    {
        array_map(
            function (string $column) {
                $this->extractColumn($column);
            },
            $this->columns
        );
        return $this;
    }

    /**
     * Extracts a single column and pushed to the properties array
     *
     * @param  string $property
     * @return void
     */
    protected function extractColumn(string $property): void
    {
        if (!in_array($property, $this->unassignable)) {
            if (property_exists($this->source, $property)) {
                $this->properties[$property] = $this->source->$property;
            }
        }
    }
}
