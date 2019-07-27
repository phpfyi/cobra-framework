<?php

namespace Cobra\Cms\ModelDataTable;

use Cobra\Cms\ModelDataTable\Element\ModelDataTableCount;
use Cobra\Cms\ModelDataTable\Element\ModelDataTableCreateButton;
use Cobra\Cms\ModelDataTable\Element\ModelDataTableElement;
use Cobra\Cms\ModelDataTable\Element\ModelDataTableHeading;
use Cobra\Cms\ModelDataTable\Element\ModelDataTableSearch;
use Cobra\Interfaces\Cms\ModelDataTable\ModelDataTableColumnInterface;
use Cobra\Interfaces\Cms\ModelDataTable\ModelDataTableInterface;
use Cobra\Interfaces\Model\ModelDataList;
use Cobra\Interfaces\Object\Props\PropsDataInterface;
use Cobra\Interfaces\View\ViewObject;
use Cobra\Model\Model;
use Cobra\Model\Relation\ModelHasManyRelation;
use Cobra\Model\Relation\ModelManyManyRelation;
use Cobra\Object\AbstractObject;
use Cobra\Object\Traits\UsesProps;
use Cobra\View\Traits\RendersTemplate;

/**
 * Model Data Table
 *
 * Generates a table interface from a model record list
 *
 * The table is a powerful UI which can be used to view, edit, and interact with
 * relations related to the record list
 *
 * Some of the actions available are:
 * - view records
 * - link relations
 * - unlink relations
 * - delete records
 *
 * The table has been designed to be as customizable as possible both in
 * appearance and functionality
 *
 * The template can be over-ridden to create custom layouts and styles if needed
 * while new elements can be added and positioned relative to the record table
 * as needed by setting the position attribute on the table element.
 *
 * The available element positions are:
 * - above-top
 * - above-left
 * - above-right
 * - above-bottom
 * - below-top
 * - below-left
 * - below-right
 * - below-bottom
 *
 * The column layout can be easily customized as needed as model properties and
 * methods can be called to populated the column value via magic methods on the
 * model class.
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
class ModelDataTable extends AbstractObject implements ModelDataTableInterface, ViewObject
{
    use RendersTemplate, UsesProps;

    /**
     * Template file path
     *
     * @var string
     */
    protected $template = 'templates.Model.ModelDataTable.ModelDataTable';

    /**
     * Is the list a many relation
     *
     * @var boolean
     */
    protected $relation = false;
    
    /**
     * Model class name
     *
     * @var string
     */
    protected $class;

    /**
     * Model definition
     *
     * @var Model
     */
    protected $model;

    /**
     * Array of table elements
     *
     * @var array
     */
    protected $elements = [];

    /**
     * Array of table columns
     *
     * @var array
     */
    protected $columns = [];

    /**
     * Table list data
     *
     * @var ModelDataList
     */
    protected $list;

    /**
     * Sets up the default configuration and elements
     *
     * @param string $name
     * @param Model $model
     * @param ModelDataList $list
     * @param ModelDataTableHeading $heading
     * @param ModelDataTableCount $count
     * @param ModelDataTableCreateButton $createButton
     * @param PropsData $props
     */
    public function __construct(
        string $name,
        Model $model,
        ModelDataList $list = null,
        ModelDataTableHeading $heading,
        ModelDataTableCount $count,
        ModelDataTableCreateButton $createButton,
        PropsDataInterface $props
    ) {
        // set default elements
        $this->setElement($heading->setHeading($name));
        $this->setElement($count->setCount($list->count()));
        $this->setElement($createButton);
        // set default configuration
        $this->setProps($props);
        $this->setModel($model);
        $this->setList($list);
    }

    /**
     * Returns whether the table list is a many relation
     *
     * @return boolean
     */
    public function isRelation(): bool
    {
        return $this->relation;
    }

    /**
     * Returns the class string
     *
     * @return string|null
     */
    public function getClass():? string
    {
        return $this->class;
    }

    /**
     * Sets the Model definition
     *
     * Also sets the table class from the passed model instance
     *
     * @param  Model $model
     * @return ModelDataTableInterface
     */
    public function setModel(Model $model): ModelDataTableInterface
    {
        $this->class = get_class($model);
        $this->model = $model;
        return $this;
    }

    /**
     * Returns the Model definition
     *
     * @return Model|null
     */
    public function getModel():? Model
    {
        return $this->model;
    }

    /**
     * Sets a table element
     *
     * @param  ModelDataTableElement $element
     * @return ModelDataTableInterface
     */
    public function setElement(ModelDataTableElement $element): ModelDataTableInterface
    {
        $this->elements[$element->getAlias()] = $element->setTable($this);
        return $this;
    }

    /**
     * Returns a table element
     *
     * @param  string $name
     * @return ModelDataTableElement|null
     */
    public function getElement(string $name):? ModelDataTableElement
    {
        return $this->elements[$name];
    }

    /**
     * Sets a table column
     *
     * @param  integer $width
     * @param  string  $heading
     * @param  string  $property
     * @return ModelDataTableInterface
     */
    public function setColumn(int $width, string $heading, string $property): ModelDataTableInterface
    {
        $this->columns[$property] = container_resolve(
            ModelDataTableColumnInterface::class,
            [
                $width,
                $property,
                $heading
            ]
        );
        return $this;
    }

    /**
     * Sets multiple table columns
     *
     * @param  array $columns
     * @param ModelDataTableInterface
     */
    public function setColumns(array $columns): ModelDataTableInterface
    {
        array_map(function (array $column) {
            $this->setColumn(...$column);
        }, $columns);
        return $this;
    }

    /**
     * Returns an array of all table columns
     *
     * @return array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * Sets the table data list
     *
     * Updates the configuration if the list is a many list
     *
     * The config values set here are used within the [data-config] HTML
     * attribute on the table as JavaScript hooks when actions are performed.
     *
     * @param  ModelDataList $list
     * @return ModelDataTableInterface
     */
    public function setList(ModelDataList $list): ModelDataTableInterface
    {
        $this->props->set('class', $this->class);
        $this->list = $list;
        // is many list
        if ($this->list instanceof ModelHasManyRelation || $this->list instanceof ModelManyManyRelation) {
            // set many relation config
            $this->relation = true;
            $this->props->set('relation', $this->list->getRelation());
            // set search
            $this->setElement(ModelDataTableSearch::resolve());
            // set has many configuration
            if ($this->list instanceof ModelHasManyRelation) {
                $this->props
                    ->set('action', 'has-many')
                    ->set('search-class', $this->list->getRelationClass());
            }
            // set many many configuration
            if ($this->list instanceof ModelManyManyRelation) {
                $this->props
                    ->set('action', 'many-many')
                    ->set('search-class', $this->list->getForeignClass());
            }
        }
        return $this;
    }

    /**
     * Returns the table data list
     *
     * @return ModelDataList
     */
    public function getList(): ModelDataList
    {
        return $this->list;
    }

    /**
     * Returns an array of elements by template position
     *
     * @param  string $position
     * @return array
     */
    public function getElementsByPosition(string $position): array
    {
        return array_filter(
            $this->elements,
            function ($element) use ($position) {
                return $element->getPosition() == $position;
            }
        );
    }

    /**
     * Returns an array of view data
     *
     * @return array
     */
    public function getViewData(): array
    {
        return [
            'list' => $this->getList(),
            'props' => $this->getProps(),
            'columns' => $this->getColumns(),
            'is_relation' => $this->isRelation(),
            'elements_above_top' => $this->getElementsByPosition('above-top'),
            'elements_above_left' => $this->getElementsByPosition('above-left'),
            'elements_above_right' => $this->getElementsByPosition('above-right'),
            'elements_above_bottom' => $this->getElementsByPosition('above-bottom'),
            'elements_below_top' => $this->getElementsByPosition('below-top'),
            'elements_below_left' => $this->getElementsByPosition('below-left'),
            'elements_below_right' => $this->getElementsByPosition('below-right'),
            'elements_below_bottom' => $this->getElementsByPosition('below-bottom'),
        ];
    }
}
