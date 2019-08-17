<?php

namespace Cobra\Model\Factory;

use ReflectionClass;
use Cobra\Interfaces\Object\SingletonInterface;
use Cobra\Model\Model;
use Cobra\Object\AbstractObject;
use Cobra\Object\Traits\SingletonMethods;

/**
 * Class Factory
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
class ClassFactory extends AbstractObject implements SingletonInterface
{
    use SingletonMethods;

    /**
     * Array of model namespaces
     *
     * @var array
     */
    protected $namespaces = [];

    /**
     * Array of reflection model classes
     *
     * @var array
     */
    protected $reflectionClasses = [];

    /**
     * Array of model tables and namespaces
     *
     * @var array
     */
    protected $tables = [];

    /**
     * Sets up the singleton instance
     *
     * @return ClassFactory
     */
    public static function instance(): ClassFactory
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new static();

            $instance->boot();
        }
        return $instance;
    }

    /**
     * Boots the class by setting up the namespaces array.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->namespaces = subclasses(Model::class);

        array_map(
            function (string $namespace) {
                $model = (new ReflectionClass($namespace))->newInstanceWithoutConstructor();

                $this->reflectionClasses[$namespace] = $model;
                $this->tables[$model->getTable()] = $namespace;
            },
            $this->namespaces
        );
    }

    /**
     * Returns an array of model namespaces.
     *
     * @return array
     */
    public function getNamespaces(): array
    {
        return $this->namespaces;
    }

    /**
     * Returns an array of model reflection classes.
     *
     * @return array
     */
    public function getReflectionClasses(): array
    {
        return $this->reflectionClasses;
    }

    /**
     * Returns a model namespace for a table.
     *
     * @param string $table
     * @return string
     */
    public function getNamespaceForTable(string $table): string
    {
        return $this->tables[$table];
    }

    /**
     * Returns a model singleton instance from the model table name.
     *
     * @param string $table
     * @return Model
     */
    public function getSingletonForTable(string $table): Model
    {
        return singleton($this->tables[$table]);
    }

    /**
     * Returns a new model instance from the model table name.
     *
     * @param string $table
     * @return Model
     */
    public function getInstanceForTable(string $table): Model
    {
        return container_resolve($this->tables[$table]);
    }

    /**
     * Returns a model table name based off the model class name.
     *
     * @param string $namespace
     * @return string
     */
    public function getTableForNamespace(string $namespace): string
    {
        return $this->reflectionClasses[$namespace]->getTable();
    }
}
