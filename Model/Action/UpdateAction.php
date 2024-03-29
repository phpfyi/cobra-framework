<?php

namespace Cobra\Model\Action;

use Cobra\Database\Factory\QueryFactory;
use Cobra\Database\Query\Condition\Condition;
use Cobra\Model\Model;

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
     * Record exists in database
     *
     * @var boolean
     */
    protected $existing = false;

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
        $this->table = schema($namespace)->get('table');
        $this->existing = $this->hasExistingRecord();
        $this->columns = $this->getChangedColumns();
        
        if (!empty($this->columns)) {
            $this->existing
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
        $this->columns = $this->model->extractFromClass($this->namespace, false);

        if (!$this->existing) {
            return $this->columns;
        }
        return array_intersect_key(
            $this->columns,
            array_intersect_key(
                $this->changed,
                schema($this->namespace)->columns()->getColumnsWithHasOne()
            )
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
            ->where('id', '=', $this->id)
            ->limit(1)
            ->fetch()->count > 0;
    }

    /**
     * Create a new record.
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
            ->where('id', '=', $this->id)
            ->limit(1);
    }
}
