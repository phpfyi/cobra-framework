<?php

namespace Cobra\Auth\Group;

use Cobra\Auth\User\User;
use Cobra\Cms\Traits\ModelConfigValidationRules;
use Cobra\Cms\Traits\ModelDataTableColumns;
use Cobra\Model\Model;
use Cobra\Model\ModelDatabaseTable;

/**
 * Group Model
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
class Group extends Model
{
    use ModelConfigValidationRules, ModelDataTableColumns;

    /**
     * Model table name
     *
     * @var string
     */
    protected $table = 'Group';

    /**
     * Model singular name
     *
     * @var string
     */
    protected $singular = 'Group';

    /**
     * Model plural name
     *
     * @var string
     */
    protected $plural = 'Groups';

    /**
     * Model icon path
     *
     * @var string
     */
    protected $icon = 'group';

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
        $schema->varchar('identifier');

        $schema->manyMany('Users', User::class);

        return $schema;
    }
}
