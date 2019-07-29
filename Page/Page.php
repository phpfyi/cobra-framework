<?php

namespace Cobra\Page;

use Cobra\Asset\Image;
use Cobra\Form\Field\SelectField;
use Cobra\Interfaces\Form\FormInterface;
use Cobra\Interfaces\Html\HtmlElementInterface;
use Cobra\Interfaces\Page\PageInterface;
use Cobra\Model\Model;
use Cobra\Model\ModelDatabaseTable;
use Cobra\Page\Form\Field\PageSerpHtmlElement;
use Cobra\Page\PageBlock;
use Cobra\Page\Model\PageCategory;
use Cobra\Page\Model\PageComment;
use Cobra\Page\Model\PageRating;
use Cobra\Page\Model\PageTag;
use Cobra\Page\Traits\PageDataTableColumns;
use Cobra\Page\Traits\PageDataTableStatus;

/**
 * Page
 *
 * The main CMS page model
 *
 * Managed through the CMS UI
 *
 * Can be sub classed to create specific page types
 *
 * Provides all the fields required for an SEO friendly HTML webpage including:
 * - H1
 * - Meta
 * - social sharing
 * - crawling / indexing
 * - sitemap configuration
 *
 * A URL segment is automatically generated from the title field
 *
 * A page record can be defined as a particular page "class" which will grant
 * access to that page class fields
 *
 * When switching between page types the data is kept for each type meaning
 * a page can be easily swiched to another class without the worry of
 * rebuilding data across fields
 *
 * A page layout consists of blocks which are self contained models containing
 * fields and logic.
 *
 * By breaking a layout into blocks it allows flexibility within the order of
 * the blocks, makes things easier to test, and allows easy re-use across
 * different pages.
 *
 * Comments and ratings are relations by default on any page which can be
 * called within the front end of the page if required
 *
 * A controller can also be attached to a page which allows actions and advanced
 * logic to be easily accessible on a particular page
 *
 * Creating a page record ties a particular route to the record that will
 * override any custom routing defined in config files
 *
 * The form method below is a good example of overriding CMS fields within
 * the form() method to create complex and unique layouts by adding, moving,
 * removing form fields
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
class Page extends Model implements PageInterface
{
    use PageDataTableColumns, PageDataTableStatus;

    /**
     * Model table name
     *
     * @var string
     */
    protected $table = 'Page';

    /**
     * Model singular name
     *
     * @var string
     */
    protected $singular = 'Page';

    /**
     * Model plural name
     *
     * @var string
     */
    protected $plural = 'Pages';

    /**
     * Model icon path
     *
     * @var string
     */
    protected $icon = 'page';

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
        $schema->varchar('class');
        $schema->varchar('controller');
        $schema->varchar('amp_controller');
        $schema->varchar('title');
        $schema->varchar('segment');
        $schema->int('status');
        $schema->date('published');
        $schema->varchar('h1');
        $schema->varchar('meta_title');
        $schema->text('meta_description');
        $schema->varchar('canonical');
        $schema->varchar('robots');
        $schema->varchar('twitter_card');
        $schema->varchar('twitter_site');
        $schema->varchar('og_type');
        $schema->varchar('og_sitename');
        $schema->varchar('og_locale');
        $schema->decimal('priority')->setLength('3,2');
        $schema->varchar('change_frequency');
        // has one
        $schema->hasOne('parent', Page::class, 'Children');
        $schema->hasOne('social_image', Image::class);
        // has many
        $schema->hasMany('Comments', PageComment::class);
        $schema->hasMany('Ratings', PageRating::class);
        $schema->hasMany('Children', Page::class);
        // many many
        $schema->manyMany('Tags', PageTag::class);
        $schema->manyMany('Categories', PageCategory::class);
        $schema->manyMany('Blocks', PageBlock::class);

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
        // set select fields
        $form->setField(SelectField::resolve('controller')->setData(page_controllers()));
        $form->setField(SelectField::resolve('amp_controller')->setData(page_controllers()));
        $form->setField(SelectField::resolve('class')->setData(page_classes()));
        $form->setField(SelectField::resolve('status')->setData(config('status.options')));
        $form->setField(SelectField::resolve('robots')->setData(config('seo.robots')));
        $form->setField(SelectField::resolve('change_frequency')->setData(config('seo.change_frequency')));
        $form->setField(SelectField::resolve('twitter_card')->setData(config('seo.twitter_card')));
        $form->setField(SelectField::resolve('og_type')->setData(config('seo.og_type')));
        $form->setField(SelectField::resolve('og_locale')->setData(config('seo.og_locale')));
        // set readonly
        $form->getField('segment')->setReadonly();
        // set labels
        $form->getField('og_type')->setLabel('OG type');
        $form->getField('og_sitename')->setLabel('OG sitename');
        $form->getField('og_locale')->setLabel('OG locale');
        // set attributes
        $form->getField('priority')->setAttribute('step', '0.01');
        $form->getField('segment')->setAttribute('data-path', parent_path($this));
        // set classes
        $form->getField('title')->addClass('title-segment');
        $form->getField('meta_title')->addClass('meta-title-handler');
        $form->getField('meta_description')->addClass('meta-desc-handler');
        // set folders
        $form->getField('social_imageID')->setFolderName('Social');
        // set field position
        $form->insertBefore('segment', $form->getField('parentID'));
        $form->insertAfter('og_locale', $form->getField('social_imageID'));
        // set headings
        $form->insertBefore('meta_title', PageSerpHtmlElement::resolve('div', 'serp')->setUri($this->segment));
        $form->insertBefore('class', container_resolve(HtmlElementInterface::class, ['h4', 's1', 'Class']));
        $form->insertBefore('title', container_resolve(HtmlElementInterface::class, ['h4', 's2', 'Content']));
        $form->insertBefore('serp', container_resolve(HtmlElementInterface::class, ['h4', 's3', 'Search Engine Optimisation']));
        $form->insertBefore('priority', container_resolve(HtmlElementInterface::class, ['h4', 's4', 'Sitemap']));
        // set validation
        $form->setValidators(Page::config('validation_rules'));

        return $form;
    }

    /**
     * Returns the page block count
     *
     * @return integer
     */
    public function tableCount(): int
    {
        return $this->Blocks()->count();
    }

    /**
     * Returns the public path absolute URL
     *
     * @return string
     */
    public function getAbsoluteURL(): string
    {
        return uri_join_host($this->segment);
    }

    /**
     * Returns the table URL HTML element
     *
     * @return string
     */
    public function tableUrl(): string
    {
        return sprintf('<a href="%s" target="_blank">%s</a>', $this->segment, $this->segment);
    }
}
