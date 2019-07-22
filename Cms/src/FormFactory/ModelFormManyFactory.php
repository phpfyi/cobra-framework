<?php

namespace Cobra\Cms\FormFactory;

use Iterator;
use Cobra\Cms\ModelDataTable\ModelDataTable;
use Cobra\Form\Form;
use Cobra\Interfaces\Form\FormInterface;
use Cobra\Model\Model;
use Cobra\Object\AbstractObject;

/**
 * Model Form Many Factory
 *
 * @category  CMS
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
abstract class ModelFormManyFactory extends AbstractObject
{
    /**
     * The Form instance
     *
     * @var Form
     */
    protected $form;

    /**
     * Array of model relation schema
     *
     * @var array
     */
    protected $relations = [];

    /**
     * Model record instance
     *
     * @var Model
     */
    protected $record;

    /**
     * Table action base request path
     *
     * @var string
     */
    protected $path;

    /**
     * Array of built table interfaces
     *
     * @var array
     */
    protected $tables = [];

    /**
     * Sets the required properties
     *
     * @param FormInterface $form
     * @param array  $relations
     * @param Model  $record
     * @param string $path
     */
    public function __construct(FormInterface $form, array $relations, Model $record, string $path)
    {
        $this->form = $form;
        $this->relations = $relations;
        $this->record = $record;
        $this->path = $path;
    }

    /**
     * Pushes the fields to the form
     *
     * @return void
     */
    abstract public function pushToForm(): void;

    /**
     * Sets a has many / many many table
     *
     * @param  string   $name
     * @param  Model    $model
     * @param  Iterator $data
     * @return void
     */
    protected function setManyTable(string $name, Model $model, Iterator $data): void
    {
        $table = $model->cmsTable(
            ModelDataTable::resolve(
                $name,
                $model,
                $data
            )
        );
        $table->getProps()
            ->set('basePath', $this->path.'/'.$name)
            ->set('parentClass', get_class($this->record))
            ->set('parentID', $this->record->id);

        $this->tables[$name] = $table;
    }
}
