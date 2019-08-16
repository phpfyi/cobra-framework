<?php

namespace Cobra\Model\Action;

use Cobra\ORM\Factory\QueryFactory;

/**
 * Insert Action
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
class InsertAction extends Action
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
     * Array of changed columns for the class.
     *
     * @var array
     */
    protected $columns = [];

    /**
     * Processes a model hierarchy namespace.
     *
     * @param string $namespace
     * @return void
     */
    protected function processNamespace(string $namespace): void
    {
        $this->columns = $this->model->extractFromClass($namespace, false);

        if ($this->id) {
            $this->columns['id'] = $this->id;
        }
        $this->statement = container_resolve(QueryFactory::class)
            ->insert(schema($namespace)->get('table'))
            ->columns($this->columns);

        $this->id = $this->statement->execute();

        $this->model->id = $this->id;
    }
}
