<?php

namespace Cobra\Model\Cache;

use Cobra\Interfaces\Object\SingletonInterface;
use Cobra\Model\Model;
use Cobra\Object\AbstractObject;
use Cobra\Object\Traits\SingletonMethods;

/**
 * Object Cache
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
class ObjectCache extends AbstractObject implements SingletonInterface
{
    use SingletonMethods;

    /**
     * Array of model namespaces
     *
     * @var array
     */
    protected static $namespaces = [];

    /**
     * Array of model instances
     *
     * @var array
     */
    protected static $instances = [];

    /**
     * Sets up the singleton instance
     *
     * @return ObjectCache
     */
    public static function instance(): ObjectCache
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new static();

            self::$namespaces = subclasses(Model::class);

            array_map(
                function ($namespace) {
                    $model = singleton($namespace);
                    self::$instances[$model->getTable()] = $model;
                },
                self::$namespaces
            );
        }
        return $instance;
    }

    /**
     * Returns the class namespaces map array
     *
     * @return array
     */
    public function getNamespaces(): array
    {
        return self::$namespaces;
    }

    /**
     * Returns the class instances map array
     *
     * @return array
     */
    public function getInstances(): array
    {
        return self::$instances;
    }

    /**
     * Returns a model by table name
     *
     * @param  string $tableName
     * @return Model
     */
    public function getInstance(string $tableName): Model
    {
        return self::$instances[$tableName];
    }
}
