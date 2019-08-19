<?php

namespace Cobra\Model\Query;

use Cobra\Interfaces\Model\ModelInterface;
use Cobra\Database\Query\SelectQuery;
use Cobra\Model\ModelDataList\ModelDataList;
use Cobra\Model\Traits\ModelPolymorphism;
use Cobra\Model\Store\ModelQueryStore;

/**
 * Model Select Query
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

class ModelSelectQuery extends SelectQuery
{
    use ModelPolymorphism;

    /**
     * Sets the required properties.
     *
     * @param string $namespace
     */
    public function __construct(string $namespace)
    {
        $this->model = singleton($namespace);

        $this->table = $this->model->getTable();
        $this->class = $namespace;
        $this->store = container_resolve(ModelQueryStore::class, [schema($namespace)]);
        
        $this->setQID();

        $this->sort('created', 'ASC');

        $hierarchy = schema($this->class)->hierarchy();
        array_shift($hierarchy);
        array_map(
            function (string $class) {
                $table = schema($class)->get('table');
                $this
                    ->joinLeft($table)
                    ->on("{$this->table}.id", '=', "{$table}.id");
            },
            $hierarchy
        );
    }

    /**
     * Returns a single model or null on failure.
     *
     * @return ModelInterface|null
     */
    public function one():? ModelInterface
    {
        $this->limit(1);

        return $this->runPolymorphism($this->fetch() ?: null);
    }

    /**
     * Returns an array of models.
     *
     * @param boolean $list
     * @return array|ModelDataList
     */
    public function all($list = true)
    {
        $records = $this->runPolymorphismArray($this->fetch());
        return $list ? ModelDataList::resolve($records) : $records;
    }
}
