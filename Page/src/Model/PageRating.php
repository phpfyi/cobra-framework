<?php

namespace Cobra\Page\Model;

use Cobra\Auth\User\User;
use Cobra\Cms\Traits\ModelConfigValidationRules;
use Cobra\Cms\Traits\ModelDataTableColumns;
use Cobra\Model\Model;
use Cobra\Model\ModelDatabaseTable;
use Cobra\Page\Page;

/**
 * Page Rating
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
class PageRating extends Model
{
    use ModelConfigValidationRules, ModelDataTableColumns;
    
    /**
     * Model table name
     *
     * @var string
     */
    protected $table = 'PageRating';

    /**
     * Model singular name
     *
     * @var string
     */
    protected $singular = 'Rating';

    /**
     * Model plural name
     *
     * @var string
     */
    protected $plural = 'Ratings';

    /**
     * Model icon path
     *
     * @var string
     */
    protected $icon = 'rating';

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
        $schema->int('rating');
        $schema->varchar('ip');

        $schema->hasOne('user', User::class, 'Ratings');
        $schema->hasOne('page', Page::class, 'Ratings');

        return $schema;
    }

    /**
     * Returns the model title text
     *
     * @return string
     */
    public function title(): string
    {
        return $this->rating;
    }
}
