<?php

namespace Cobra\Model\Action;

use Cobra\Model\Model;
use Cobra\ORM\Factory\QueryFactory;
use Cobra\ORM\Query\Condition\Condition;

/**
 * Update Action
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
class UpdateAction extends Action
{
    /**
     * Method hook before process
     *
     * @var string
     */
    protected $methodBefore = 'beforeSave';

    /**
     * Method hook after process
     *
     * @var string
     */
    protected $methodAfter = 'afterSave';

    /**
     * Array of changed columns.
     *
     * @var array
     */
    protected $changed = [];

    /**
     * Array of changed columns for the namespace.
     *
     * @var array
     */
    protected $columns = [];
    
    /**
     * Model class namespace
     *
     * @var string
     */
    protected $namespace;

    /**
     * Model database table
     *
     * @var string
     */
    protected $table;

    /**
     * Sets the required properties
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
        
        $this->id = $model->id;
        $this->changed = $this->model->changed();
    }

    /**
     * Processes a model hierarchy namespace.
     *
     * @param string $namespace
     * @return void
     */
    protected function processNamespace(string $namespace): void
    {
        $this->namespace = $namespace;
        $this->columns = $this->getChangedColumns($namespace);
        $this->table = schema($namespace)->get('table');
        
        if (!empty($this->columns)) {
            $this->hasExistingRecord()
            ? $this->updateRecord()
            : $this->createRecord();

            $this->statement->execute();
        }
    }

    /**
     * Returns an associative array of changed columns for the class.
     *
     * @return array
     */
    protected function getChangedColumns(): array
    {
        return array_intersect_key(
            $this->changed,
            schema($this->namespace)->columns()->getColumnsWithHasOne()
        );
    }

    /**
     * Returns if the record exists already.
     *
     * @return boolean
     */
    protected function hasExistingRecord(): bool
    {
        return container_resolve(QueryFactory::class)
            ->select($this->table)
            ->count('id')
            ->where(function (Condition $condition) {
                $condition
                    ->column('id', '=', $this->id);
            })
            ->limit(1)
            ->bind([$this->id])
            ->fetch()->count > 0;
    }

    /**
     * Create a new record
     *
     * @return void
     */
    protected function createRecord(): void
    {
        $this->columns['id'] = $this->id;
            
        $this->statement = container_resolve(QueryFactory::class)
            ->insert($this->table)
            ->columns($this->columns);
    }

    /**
     * Updates the existing record.
     *
     * @return void
     */
    protected function updateRecord(): void
    {
        $this->statement = container_resolve(QueryFactory::class)
            ->update($this->table)
            ->columns($this->columns)
            ->where(function (Condition $condition) {
                $condition->column('id', '=', $this->id);
            })
            ->limit(1)
            ->bind([$this->id]);
    }
}
