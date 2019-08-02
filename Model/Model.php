<?php

namespace Cobra\Model;

use Cobra\Interfaces\Cms\ModelDataTable\ModelDataTableInterface;
use Cobra\Interfaces\Form\FormInterface;
use Cobra\Interfaces\Model\ModelInterface;

/**
 * Model
 *
 * The base model class
 *
 * Represent a single database record
 *
 * Uses static and non static function calls to access model data and records.
 *
 * Sub classes can implement various methods to generate database fields, CMS
 * configuration and many other things for the model.
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
abstract class Model extends ModelManager implements ModelInterface
{
    /**
     * Model table name
     *
     * @var string
     */
    protected $table;

    /**
     * Model singular name
     *
     * @var string
     */
    protected $singular;

    /**
     * Model plural name
     *
     * @var string
     */
    protected $plural;

    /**
     * Whether to show in the CMS menu
     *
     * @var bool
     */
    protected $inMenu = true;

    /**
     * Non writable properties
     *
     * @var bool
     */
    protected $unassignable = [
        'id',
        'created',
        'updated'
    ];

    /**
     * Magic method to handle calling methods via a property call
     *
     * @param  string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        if (method_exists($this, $name)) {
            return $this->$name();
        }
    }

    /**
     * Returns the database table name.
     *
     * @return string
     */
    public function getTable(): string
    {
        return $this->table ?? short_name(static::class);
    }

    /**
     * Returns the model singular name.
     *
     * @return string
     */
    public function getSingular(): string
    {
        return $this->singular ?? short_name(static::class);
    }

    /**
     * Returns the model plural name.
     *
     * @return string
     */
    public function getPlural(): string
    {
        return $this->plural;
    }

    /**
     * Returns whether the model shows in the CMS menu.
     *
     * @return bool
     */
    public function getInMenu(): bool
    {
        return $this->inMenu;
    }

    /**
     * Returns an array of the non writable model properties.
     *
     * @return string
     */
    public function getUnassignable(): array
    {
        return $this->unassignable;
    }

    /**
     * Returns a more human readable created date value.
     *
     * @return string
     */
    public function tableDate(): string
    {
        return date('jS M Y', strtotime($this->created));
    }

    /**
     * Sets the database table configuration.
     *
     * @param  ModelDatabaseTable $schema
     * @return ModelDatabaseTable
     */
    abstract public function databaseTable(ModelDatabaseTable $schema): ModelDatabaseTable;

    /**
     * Sets the CMS form record configuration.
     *
     * @param  FormInterface $form
     * @return FormInterface
     */
    abstract public function cmsForm(FormInterface $form): FormInterface;

    /**
     * Sets the CMS table configuration.
     *
     * @param  ModelDataTableInterface $table
     * @return ModelDataTableInterface
     */
    abstract public function cmsTable(ModelDataTableInterface $table): ModelDataTableInterface;
}
