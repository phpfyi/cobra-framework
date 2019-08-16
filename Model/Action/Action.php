<?php

namespace Cobra\Model\Action;

use Cobra\Model\Model;
use Cobra\Object\AbstractObject;

/**
 * Action
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
abstract class Action extends AbstractObject
{
    /**
     * Model instance
     *
     * @var Model
     */
    protected $model;

    /**
     * Model ID
     *
     * @var int
     */
    protected $id;

    /**
     * Method hook before process
     *
     * @var string
     */
    protected $methodBefore;

    /**
     * Method hook after process
     *
     * @var string
     */
    protected $methodAfter;

    /**
     * Statement instance
     *
     * @var Statement
     */
    protected $statement;

    /**
     * Sets the required properties.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Processes the class hierarchy handing each namespace to the child class
     * processNamespace method.
     *
     * @return bool
     */
    public function process(): bool
    {
        if (method_exists($this->model, $this->methodBefore)) {
            $this->model->{$this->methodBefore}();
        }
        array_map(
            function (string $namespace) {
                $this->processNamespace($namespace);
            },
            schema($this->model)->hierarchy(true)
        );
        if (method_exists($this->model, $this->methodAfter)) {
            $this->model->{$this->methodAfter}();
        }
        return true;
    }

    /**
     * Processes a model hierarchy namespace.
     *
     * @param string $namespace
     * @return void
     */
    abstract protected function processNamespace(string $namespace): void;
}
