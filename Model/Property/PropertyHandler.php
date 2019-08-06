<?php

namespace Cobra\Model\Property;

use Cobra\Model\Model;
use Cobra\Object\AbstractObject;

/**
 * Property Handler
 *
 * Handles binding properties to and extracting properites from a model.
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
class PropertyHandler extends AbstractObject
{
    /**
     * Model instance
     *
     * @var Model
     */
    protected $model;

    /**
     * Sets the model instance
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Bind properties from the entire class hierarchy
     *
     * @param  array   $data
     * @param  boolean $unassignable
     * @return Model
     */
    public function bind(array $data, bool $unassignable = false): Model
    {
        array_map(
            function ($namespace) use ($data, $unassignable) {
                $this->bindToClass($namespace, $data, $unassignable);
            },
            schema($this->model)->hierarchy()
        );
        return $this->model;
    }

    /**
     * Bind properties from the current class only
     *
     * @param  array   $data
     * @param  boolean $unassignable
     * @return Model
     */
    public function bindToModel(array $data, bool $unassignable = false): Model
    {
        $this->bindToClass(get_class($this->model), $data, $unassignable);
        return $this->model;
    }

    /**
     * Binds properties from a specific class only
     *
     * @param  string  $namespace
     * @param  array   $data
     * @param  boolean $unassignable
     * @return Model
     */
    public function bindToClass(string $namespace, array $data, bool $unassignable = false): Model
    {
        $binder = PropertyBinder::resolve(
            $this->model,
            array_merge(
                schema($namespace)->columns()->getNamesWithHasOne()
            ),
            $data,
            $unassignable ? [] : $this->model->getUnassignable()
        );
        $binder->doBind();
        return $this->model;
    }

    /**
     * Extracts properties from the entire class hierarchy
     *
     * @param  boolean $unassignable
     * @return array
     */
    public function extract(bool $unassignable = true): array
    {
        $properties = [];
        array_map(
            function ($namespace) use (&$properties, $unassignable) {
                $properties = array_merge(
                    $properties,
                    $this->extractFromClass($namespace, $unassignable)
                );
            },
            schema($this->model)->hierarchy()
        );
        return $properties;
    }
    
    /**
     * Extracts properties from the current class
     *
     * @param  boolean $unassignable
     * @return array
     */
    public function extractFromModel(bool $unassignable = true): array
    {
        return $this->extractFromClass(get_class($this->model), $unassignable);
    }

    /**
     * Extracts properties from a specific class
     *
     * @param  string  $namespace
     * @param  boolean $unassignable
     * @return array
     */
    public function extractFromClass(string $namespace, bool $unassignable = true): array
    {
        $extractor = PropertyExtractor::resolve(
            $this->model,
            array_merge(
                schema($namespace)->columns()->getNamesWithHasOne()
            ),
            $unassignable ? [] : $this->model->getUnassignable()
        );
        return $extractor->doExtraction()->getProperties();
    }
}
