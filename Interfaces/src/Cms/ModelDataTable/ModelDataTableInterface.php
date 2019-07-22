<?php

namespace Cobra\Interfaces\Cms\ModelDataTable;

use Cobra\Interfaces\Model\ModelDataList;
use Cobra\Cms\ModelDataTable\Element\ModelDataTableElement;
use Cobra\Model\Model;

/**
 * Model Data Table interface
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
interface ModelDataTableInterface
{
    /**
     * Returns whether the table list is a many relation
     *
     * @return boolean
     */
    public function isRelation(): bool;

    /**
     * Returns the class string
     *
     * @return string|null
     */
    public function getClass():? string;

    /**
     * Sets the Model definition
     *
     * Also sets the table class from the passed model instance
     *
     * @param  Model $model
     * @return ModelDataTableInterface
     */
    public function setModel(Model $model): ModelDataTableInterface;

    /**
     * Returns the Model definition
     *
     * @return Model|null
     */
    public function getModel():? Model;

    /**
     * Sets a table element
     *
     * @param  ModelDataTableElement $element
     * @return ModelDataTableInterface
     */
    public function setElement(ModelDataTableElement $element): ModelDataTableInterface;

    /**
     * Returns a table element
     *
     * @param  string $name
     * @return ModelDataTableElement|null
     */
    public function getElement(string $name):? ModelDataTableElement;

    /**
     * Sets a table column
     *
     * @param  integer $width
     * @param  string  $heading
     * @param  string  $property
     * @return ModelDataTableInterface
     */
    public function setColumn(int $width, string $heading, string $property): ModelDataTableInterface;

    /**
     * Sets multiple table columns
     *
     * @param  array $columns
     * @param ModelDataTableInterface
     */
    public function setColumns(array $columns): ModelDataTableInterface;

    /**
     * Returns an array of all table columns
     *
     * @return array
     */
    public function getColumns(): array;

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
    public function setList(ModelDataList $list): ModelDataTableInterface;

    /**
     * Returns the table data list
     *
     * @return ModelDataList
     */
    public function getList(): ModelDataList;

    /**
     * Returns an array of elements by template position
     *
     * @param  string $position
     * @return array
     */
    public function getElementsByPosition(string $position): array;
}
