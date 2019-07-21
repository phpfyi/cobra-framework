<?php

namespace Cobra\Cms\Model;

use Cobra\Cms\Model\Menu;
use Cobra\Cms\Traits\ModelDataTableColumns;
use Cobra\Interfaces\Form\FormInterface;
use Cobra\Ecommerce\Currency\Currency;
use Cobra\Form\Field\SelectField;
use Cobra\Model\Model;
use Cobra\Model\ModelDatabaseTable;

/**
 * Application Settings
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
class SiteSettings extends Model
{
    use ModelDataTableColumns;

    /**
     * Model table name
     *
     * @var string
     */
    protected $table = 'SiteSettings';

    /**
     * Model singular name
     *
     * @var string
     */
    protected $singular = 'Settings';

    /**
     * Model plural name
     *
     * @var string
     */
    protected $plural = 'Settings';

    /**
     * Model icon path
     *
     * @var string
     */
    protected $icon = 'settings';

    /**
     * Model database schema fields
     *
     * @param  ModelDatabaseTable $schema
     * @return ModelDatabaseTable
     */
    public function databaseTable(ModelDatabaseTable $schema): ModelDatabaseTable
    {
        // fields
        $schema->primary();
        $schema->created();
        $schema->updated();
        $schema->varchar('title');
        $schema->varchar('app');
        $schema->varchar('domain');
        $schema->varchar('currency');

        $schema->hasMany('Menus', Menu::class);

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
        $form->setField(
            SelectField::resolve('currency')
                ->setData($this->getCurrencyOptions())
        );
        $form->setField(
            SelectField::resolve('app')
            ->setData(
                array_combine_from(config('apps'))
            )
        );
        $form->setField(
            SelectField::resolve('domain')
            ->setData(
                array_combine_from(
                    env('VALID_HOSTNAMES')
                )
            )
        );
        return $form;
    }

    /**
     * Returns currency select options
     *
     * @return array
     */
    private function getCurrencyOptions(): array
    {
        $currencies = [];
        array_map(
            function ($namespace) use (&$currencies) {
                $currencies[$namespace] = $namespace::resolve()->getDescription();
            },
            subclasses(Currency::class)
        );
        return $currencies;
    }
}
