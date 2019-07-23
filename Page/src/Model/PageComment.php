<?php

namespace Cobra\Page\Model;

use Cobra\Auth\User\User;
use Cobra\Cms\Traits\ModelDataTableColumns;
use Cobra\Interfaces\Form\FormInterface;
use Cobra\Form\Field\SelectField;
use Cobra\Model\Model;
use Cobra\Model\ModelDatabaseTable;
use Cobra\Page\Page;
use Cobra\Page\Traits\PageDataTableStatus;

/**
 * Page Comment
 *
 * @category  Page
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class PageComment extends Model
{
    use ModelDataTableColumns, PageDataTableStatus;

    /**
     * Model table name
     *
     * @var string
     */
    protected $table = 'PageComment';

    /**
     * Model singular name
     *
     * @var string
     */
    protected $singular = 'Comment';

    /**
     * Model plural name
     *
     * @var string
     */
    protected $plural = 'Comments';

    /**
     * Model icon path
     *
     * @var string
     */
    protected $icon = 'comment';

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
        $schema->text('comment');
        $schema->varchar('ip_address');
        $schema->int('status');

        $schema->hasOne('user', User::class, 'Comments');
        $schema->hasOne('page', Page::class, 'Comments');

        return $schema;
    }

    /**
     * Model CMS form fields override
     *
     * @param  FormInterface $form
     * @return FormInterface
     */
    public function cmsForm(FormInterface $form): FormInterface
    {
        $form->setField(SelectField::resolve('status')->setData(config('status.options')));
        $form->setValidators(static::config('validation_rules'));

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
