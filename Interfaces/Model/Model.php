<?php

namespace Cobra\Interfaces\Model;

use Cobra\Interfaces\Cms\ModelDataTable\ModelDataTableInterface;
use Cobra\Interfaces\Form\FormInterface;

/**
 * Model Interface
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
interface ModelInterface
{
    /**
     * Returns the database table name.
     *
     * @return string
     */
    public function getTable(): string;

    /**
     * Returns the model singular name.
     *
     * @return string
     */
    public function getSingular(): string;

    /**
     * Returns the model plural name.
     *
     * @return string
     */
    public function getPlural(): string;

    /**
     * Returns whether the model shows in the CMS menu.
     *
     * @return bool
     */
    public function getInMenu(): bool;

    /**
     * Returns an array of the non writable model properties.
     *
     * @return string
     */
    public function getUnassignable(): array;

    /**
     * Returns a more human readable created date value.
     *
     * @return string
     */
    public function tableDate(): string;

    /**
     * Sets the database table configuration.
     *
     * @param  ModelDatabaseTable $schema
     * @return ModelDatabaseTable
     */
    public function databaseTable(ModelDatabaseTable $schema): ModelDatabaseTable;

    /**
     * Sets the CMS form record configuration.
     *
     * @param  FormInterface $form
     * @return FormInterface
     */
    public function cmsForm(FormInterface $form): FormInterface;

    /**
     * Sets the CMS table configuration.
     *
     * @param  ModelDataTableInterface $table
     * @return ModelDataTableInterface
     */
    public function cmsTable(ModelDataTableInterface $table): ModelDataTableInterface;
}
