<?php

namespace Cobra\Auth\User;

use Cobra\Auth\User\User;
use Cobra\Cms\Traits\ModelConfigValidationRules;
use Cobra\Cms\Traits\ModelDataTableColumns;
use Cobra\Interfaces\Auth\User\UserLogInterface;
use Cobra\Model\Model;
use Cobra\Model\ModelDatabaseTable;

/**
 * User Log Model
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
class UserLog extends Model implements UserLogInterface
{
    use ModelConfigValidationRules, ModelDataTableColumns;

    /**
     * Model table name
     *
     * @var string
     */
    protected $table = 'UserAction';

    /**
     * Model singular name
     *
     * @var string
     */
    protected $singular = 'User Log';

    /**
     * Model plural name
     *
     * @var string
     */
    protected $plural = 'User Logs';

    /**
     * Model icon path
     *
     * @var string
     */
    protected $icon = 'log';

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
        $schema->varchar('action');
        $schema->varchar('result');
        $schema->varchar('ip_address');

        $schema->hasOne('User', User::class, 'Logs');

        return $schema;
    }

    /**
     * Returns the model title text
     *
     * @return string
     */
    public function title(): string
    {
        return $this->action;
    }
}
