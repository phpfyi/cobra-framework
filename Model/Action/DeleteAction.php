<?php

namespace Cobra\Model\Action;

use Cobra\Model\Model;
use Cobra\ORM\Factory\QueryFactory;
use Cobra\ORM\Query\Condition\Condition;

/**
 * Delete Action
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
class DeleteAction extends Action
{
    /**
     * Method hook before process
     *
     * @var string
     */
    protected $methodBefore = 'beforeDelete';

    /**
     * Method hook after process
     *
     * @var string
     */
    protected $methodAfter = 'afterDelete';

    /**
     * Sets the required properties
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
        
        $this->id = $model->id;
    }

    /**
     * Processes a model hierarchy namespace.
     *
     * @param string $namespace
     * @return void
     */
    protected function processNamespace(string $namespace): void
    {
        $this->statement = container_resolve(QueryFactory::class)
            ->delete(schema($namespace)->get('table'))
            ->where(function (Condition $condition) {
                $condition->column('id', '=', $this->id);
            })
            ->limit(1)
            ->bind([$this->id]);

        $this->statement->execute();
    }
}
