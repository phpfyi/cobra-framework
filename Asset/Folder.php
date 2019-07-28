<?php

namespace Cobra\Asset;

use Cobra\Cms\Traits\ModelConfigValidationRules;
use Cobra\Cms\Traits\ModelDataTableColumns;
use Cobra\Interfaces\Asset\FolderInterface;
use Cobra\Interfaces\Server\Directory\DirectoryInterface;
use Cobra\Model\Model;
use Cobra\Model\ModelDatabaseTable;

/**
 * Folder
 *
 * @category  Asset
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class Folder extends Model implements FolderInterface
{
    use ModelConfigValidationRules, ModelDataTableColumns;

    /**
     * Model table name
     *
     * @var string
     */
    protected $table = 'Folder';

    /**
     * Model singular name
     *
     * @var string
     */
    protected $singular = 'Folder';

    /**
     * Model plural name
     *
     * @var string
     */
    protected $plural = 'Folders';

    /**
     * Model icon path
     *
     * @var string
     */
    protected $icon = 'folder';

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
        $schema->varchar('directory');
        // has one
        $schema->hasMany('Files', File::class);

        return $schema;
    }

    /**
     * Hook called after saving to database
     *
     * @return void
     */
    public function afterSave(): void
    {
        container_resolve(DirectoryInterface::class)->create(ASSETS_DIRECTORY, $this->directory);
    }

    /**
     * Returns the child file count
     *
     * @return integer
     */
    public function tableFileCount(): int
    {
        return $this->Files()->count();
    }
}
