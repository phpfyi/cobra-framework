<?php

namespace Cobra\Model\Factory;

use Cobra\Database\Factory\DatabaseFactory;
use Cobra\Interfaces\Model\ModelInterface;
use Cobra\Model\Cache\ObjectCache;
use Cobra\Object\AbstractObject;

/**
 * Database Architect
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
class DatabaseArchitect extends AbstractObject
{
    /**
     * Array of Model instances
     *
     * @var array
     */
    protected $instances = [];

    /**
     * Array of database table instances
     *
     * @var array
     */
    protected $tables = [];

    /**
     * Sets the required properties
     *
     * @param ObjectCache $cache
     */
    public function __construct(ObjectCache $cache)
    {
        $this->instances = $cache->getInstances();
    }

    /**
     * Creates the database.
     *
     * @return void
     */
    public function createDatabase(): void
    {
        array_map(function (ModelInterface $model) {
            $this->tables[] = database_table($model);
        }, $this->instances);

        container_resolve(DatabaseFactory::class, [$this->tables])->createDatabase();
    }
}
