<?php

namespace Cobra\Cms\Model;

use Cobra\Cms\Traits\ModelConfigValidationRules;
use Cobra\Cms\Traits\ModelDataTableColumns;
use Cobra\Model\Model;
use Cobra\Model\ModelDatabaseTable;

/**
 * Menu Model
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
class Menu extends Model
{
    use ModelConfigValidationRules, ModelDataTableColumns;

    /**
     * Model table name
     *
     * @var string
     */
    protected $table = 'Menu';

    /**
     * Model singular name
     *
     * @var string
     */
    protected $singular = 'Menu';

    /**
     * Model plural name
     *
     * @var string
     */
    protected $plural = 'Menus';

    /**
     * Model icon path
     *
     * @var string
     */
    protected $icon = 'menu';

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
        // fields
        $schema->primary();
        $schema->created();
        $schema->updated();
        $schema->varchar('title');
        // has one
        $schema->hasOne('Settings', SiteSettings::class, 'Menus');
        // has many
        $schema->hasMany('MenuItems', MenuItem::class);

        return $schema;
    }
}
