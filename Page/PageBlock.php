<?php

namespace Cobra\Page;

use Cobra\Interfaces\Cms\ModelDataTable\ModelDataTableInterface;
use Cobra\Interfaces\Form\FormInterface;
use Cobra\Interfaces\View\ViewObject;
use Cobra\Model\Model;
use Cobra\Model\ModelDatabaseTable;
use Cobra\View\Traits\UsesTemplate;
use Cobra\View\Traits\RendersTemplate;

/**
 * Page Block
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
class PageBlock extends Model implements ViewObject
{
    use UsesTemplate, RendersTemplate;

    /**
     * Model table name
     *
     * @var string
     */
    protected $table = 'PageBlock';

    /**
     * Model singular name
     *
     * @var string
     */
    protected $singular = 'Page Block';

    /**
     * Model plural name
     *
     * @var string
     */
    protected $plural = 'Page Blocks';

    /**
     * Model icon path
     *
     * @var string
     */
    protected $icon = 'page';

    /**
     * Whether to show in the CMS menu
     *
     * @var boolean
     */
    protected $inMenu = false;

    /**
     * CMS description
     *
     * @var string
     */
    protected $description;

    /**
     * Preview image path
     *
     * @var string
     */
    protected $preview;

    /**
     * Template path
     *
     * @var string
     */
    protected $template;

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
        $schema->varchar('title');
        $schema->varchar('class');
        
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
        // move parent field
        $form->insertBefore('title', $form->getField('class')->setReadonly());
        // validation
        $form->getField('title')->setValidator('required');
        
        return $form;
    }
    
    /**
     * Model CMS table overrides
     *
     * @param  ModelDataTableInterface $table
     * @return ModelDataTableInterface
     */
    public function cmsTable(ModelDataTableInterface $table): ModelDataTableInterface
    {
        return $table->setColumns(PageBlock::config('table_columns'));
    }
    
    /**
     * Returns the CMS description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
    
    /**
     * Returns the CMS preview image path
     *
     * @return string
     */
    public function getPreview(): string
    {
        return $this->preview;
    }

    /**
     * Returns an array of view data
     *
     * @return array
     */
    public function getViewData(): array
    {
        return [
            'data' => $this
        ];
    }
}
