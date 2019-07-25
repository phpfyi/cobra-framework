<?php

namespace Cobra\Cms\Model;

use Cobra\Cms\Traits\ModelDataTableColumns;
use Cobra\Form\Field\SelectField;
use Cobra\Interfaces\Form\FormInterface;
use Cobra\Interfaces\Html\HtmlElementInterface;
use Cobra\Model\Model;
use Cobra\Model\ModelDatabaseTable;
use Cobra\Page\Page;

/**
 * Redirect Model
 *
 * Model representing a HTTP redirect.
 * Used in the CMS to generate redirects using PHP.
 * Takes away the need add redirects to .htaccess
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
class Redirect extends Model
{
    use ModelDataTableColumns;

    /**
     * Model table name
     *
     * @var string
     */
    protected $table = 'Redirect';

    /**
     * Model singular name
     *
     * @var string
     */
    protected $singular = 'Redirect';

    /**
     * Model plural name
     *
     * @var string
     */
    protected $plural = 'Redirects';

    /**
     * Model icon path
     *
     * @var string
     */
    protected $icon = 'redirect';

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
        $schema->int('code');
        $schema->varchar('from_type');
        $schema->varchar('from_external');
        $schema->varchar('to_type');
        $schema->varchar('to_external');

        $schema->hasOne('from_page', Page::class);
        $schema->hasOne('to_page', Page::class);

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
        $form->setField(SelectField::resolve('code')->setData(self::getRedirectStatusCodeOptions()));
        $form->setField(
            SelectField::resolve('from_type')
                ->setLabel('URL type')
                ->setData(static::config('types'))
                ->cssVisibilityParent()
        );
        $form->setField(
            SelectField::resolve('to_type')
                ->setLabel('URL type')
                ->setData(static::config('types'))
                ->cssVisibilityParent()
        );
        $form->insertBefore('from_external', $form->getField('from_pageID'));
        $form->insertBefore('to_external', $form->getField('to_pageID'));
        $form->insertBefore('code', container_resolve(HtmlElementInterface::class, ['h4', 's1', 'Status Code']));
        $form->insertBefore('from_type', container_resolve(HtmlElementInterface::class, ['h4', 's2', 'From URL']));
        $form->insertBefore('to_type', container_resolve(HtmlElementInterface::class, ['h4', 's3', 'To URL']));

        $form->getField('from_pageID')->setLabel('Page')->cssVisibilityChild('from_type', 'internal');
        $form->getField('from_external')->setLabel('External URL')->cssVisibilityChild('from_type', 'external');

        $form->getField('to_pageID')->setLabel('Page')->cssVisibilityChild('to_type', 'internal');
        $form->getField('to_external')->setLabel('External URL')->cssVisibilityChild('to_type', 'external');

        $form->setValidators(static::config('validation_rules'));

        return $form;
    }
    
    /**
     * Retuns an array of HTTP status code options
     *
     * @return array
     */
    public static function getRedirectStatusCodeOptions(): array
    {
        $codes = [];
        $status = config('http.300_codes');
        array_map(
            function ($code, $description) use (&$codes) {
                $codes[$code] = $code.' - '.$description;
            },
            array_keys($status),
            $status
        );
        return $codes;
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
