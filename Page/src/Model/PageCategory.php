<?php

namespace Cobra\Page\Model;

use Cobra\Cms\Traits\ModelConfigValidationRules;
use Cobra\Cms\Traits\ModelDataTableColumns;
use Cobra\Model\Model;
use Cobra\Model\ModelDatabaseTable;

/**
 * Page Category
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
class PageCategory extends Model
{
    use ModelConfigValidationRules, ModelDataTableColumns;

    /**
     * Model table name
     *
     * @var string
     */
    protected $table = 'PageCategory';

    /**
     * Model singular name
     *
     * @var string
     */
    protected $singular = 'Category';

    /**
     * Model plural name
     *
     * @var string
     */
    protected $plural = 'Categories';

    /**
     * Model icon path
     *
     * @var string
     */
    protected $icon = 'category';

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
        $schema->varchar('title');

        return $schema;
    }
}
