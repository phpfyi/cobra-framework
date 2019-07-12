<?php

namespace Cobra\Auth\Password;

use Cobra\Auth\User\User;
use Cobra\Cms\Traits\ModelDataTableColumns;
use Cobra\Interfaces\Form\Form;
use Cobra\Model\ModelDatabaseTable;
use Cobra\Model\Model;

/**
 * Password
 *
 * @category  Auth
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class Password extends Model
{
    use ModelDataTableColumns;

    /**
     * Model table name
     *
     * @var string
     */
    protected $table = 'Password';

    /**
     * Model singular name
     *
     * @var string
     */
    protected $singular = 'Password';

    /**
     * Model plural name
     *
     * @var string
     */
    protected $plural = 'Passwords';

    /**
     * Model icon path
     *
     * @var string
     */
    protected $icon = 'password';

    /**
     * Whether to show in the CMS menu
     *
     * @var boolean
     */
    protected $inMenu = false;

    /**
     * Model database schema fields
     *
     * @param  ModelDatabaseTable $schema
     * @return ModelDatabaseTable
     */
    public function databaseTable(ModelDatabaseTable $schema): ModelDatabaseTable
    {
        $schema->primary();
        $schema->created();
        $schema->updated();
        $schema->varchar('password');

        $schema->hasOne('User', User::class, 'Passwords');

        return $schema;
    }

    /**
     * Model CMS form fields override
     *
     * @param  Form $form
     * @return Form
     */
    public function cmsForm(Form $form): Form
    {
        return $form;
    }

    /**
     * Returns the model title text
     *
     * @return string
     */
    public function title(): string
    {
        return $this->created;
    }
}
