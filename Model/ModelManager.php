<?php

namespace Cobra\Model;

use Cobra\Interfaces\Model\ModelInterface;
use Cobra\Model\Action\ActionHandler;
use Cobra\Model\Query\ModelSelectQuery;
use Cobra\Model\Property\PropertyHandler;
use Cobra\Model\Relation\RelationHandler;
use Cobra\Object\AbstractObject;

/**
 * Model Manager
 *
 * Available hooks:
 * - beforeSave
 * - afterSave
 * - afterFetch
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
class ModelManager extends AbstractObject
{
    /**
     * PropertyHandler instance
     *
     * @var PropertyHandler
     */
    protected $propertyHandler;

    /**
     * RelationHandler instance
     *
     * @var RelationHandler
     */
    protected $relationHandler;

    /**
     * ModelActionHandler instance
     *
     * @var ModelActionHandler
     */
    protected $actionHandler;

    /**
     * Sets the required properties
     */
    public function __construct()
    {
        $this->propertyHandler = container_resolve(PropertyHandler::class, [$this]);
        $this->relationHandler = container_resolve(RelationHandler::class, [$this]);
        $this->actionHandler = container_resolve(ActionHandler::class, [$this]);
    }

    /**
     * Returns one model class instance matching a specific column value
     * such as id
     *
     * @param  string $column
     * @param  mixed  $value
     * @return ModelInterface|null
     */
    public static function find(string $column, $value):? ModelInterface
    {
        return self::get()->where($column, '=', $value)->one();
    }

    /**
     * Starts a databse model query to return an array of models based
     * on conditions
     *
     * @return ModelSelectQuery
     */
    public static function get(): ModelSelectQuery
    {
        return container_resolve(ModelSelectQuery::class, [static::class]);
    }
    
    /**
     * Updates or creates a new database model record.
     *
     * @return boolean
     */
    public function save(): bool
    {
        return $this->id > 0
        ? $this->actionHandler->update()
        : $this->actionHandler->insert();
    }

    /**
     * Creates a new model database record.
     *
     * @param array $data
     * @return boolean
     */
    public function create(array $data = []): bool
    {
        return $this->bind($data)->save();
    }

    /**
     * Updates a model database record.
     *
     * @param array $data
     * @return boolean
     */
    public function update(array $data = []): bool
    {
        return $this->bind($data)->save();
    }
    
    /**
     * Deletes the model database record.
     *
     * @return boolean
     */
    public function delete(): bool
    {
        return $this->actionHandler->delete();
    }
    
    /**
     * Proxy to set a model property.
     *
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set(string $name, $value) : void
    {
        $this->propertyHandler->set($name, $value);
    }

    /**
     * Proxy to get a model property.
     *
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        if (method_exists($this, $name)) {
            return $this->$name();
        }
        return $this->propertyHandler->get($name);
    }

    /**
     * Proxy to unset a model property.
     *
     * @param string $name
     * @return void
     */
    public function __unset(string $name): void
    {
        $this->propertyHandler->unset($name);
    }

    /**
     * Proxy to check a model property is set.
     *
     * @param string $name
     * @return boolean
     */
    public function __isset(string $name): bool
    {
        return $this->propertyHandler->isset($name);
    }

    /**
     * Proxy to call a relation as a function through the relation name
     *
     * @param  string $name
     * @param  array  $arguments
     * @return mixed
     */
    public function __call(string $method, array $arguments)
    {
        // handle calls to property binding and extraction
        if (method_exists($this->propertyHandler, $method)) {
            return $this->propertyHandler->$method(...$arguments);
        }
        // handle dynamic calls to relations
        if (schema(static::class)->relations()->exists($method)) {
            return $this->relationHandler->handle($method);
        }
    }
}
