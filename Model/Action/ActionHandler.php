<?php

namespace Cobra\Model\Action;

use Cobra\Model\Model;
use Cobra\Object\AbstractObject;
use Cobra\Event\Traits\EventEmitter;

/**
 * Action Handler
 *
 * Handles all model related actions.
 *
 * Acts a central hub to easily manage all operations that modify the state of
 * a model such as updating, creating, deleting etc.
 *
 * The actions themselves are abstracted out into different action classes and
 * this class only deals with the creation of the action class, returning the
 * reaction from the action and the firing of events before and after calling
 * the action.
 *
 * Methods called here MUST return either true or false depending on the outcome
 * of the action. The class has a single responsibility - to call the action and
 * return whether its was successful. Things like determining why an action did
 * not complete should be the responsibility of the called action.
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
class ActionHandler extends AbstractObject
{
    use EventEmitter;

    /**
     * Model instance
     *
     * @var Model
     */
    protected $model;

    /**
     * Action response
     *
     * @var bool
     */
    protected $reaction;

    /**
     * Sets the required properties
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Performs a model insert action.
     *
     * @return boolean
     */
    public function insert(): bool
    {
        return $this->reaction(InsertAction::class, 'BeforeInsert', 'AfterInsert');
    }

    /**
     * Performs a model update action.
     *
     * @return boolean
     */
    public function update(): bool
    {
        return $this->reaction(UpdateAction::class, 'BeforeUpdate', 'AfterUpdate');
    }

    /**
     * Performs a model delete action.
     *
     * @return boolean
     */
    public function delete(): bool
    {
        return $this->reaction(DeleteAction::class, 'BeforeDelete', 'AfterDelete');
    }

    /**
     * Performs a model action and returns the outcome.
     *
     * @param string $actionClass
     * @param string $eventBefore
     * @param string $eventAfter
     * @return bool
     */
    protected function reaction(string $actionClass, string $eventBefore, string $eventAfter): bool
    {
        $this->emit($eventBefore, $this->model);

        $this->reaction = container_resolve($actionClass, [$this->model])->process();

        $this->emit($eventAfter, $this->model);

        return $this->reaction;
    }
}
