<?php

namespace Cobra\Cms\Controller;

use Cobra\Autoloader\ComposerAutoloader;
use Cobra\Cache\CacheInvalidator;
use Cobra\Cms\Controller\AppController;
use Cobra\Model\Migration\ModelMigrator;
use Cobra\Model\Schema\ModelSchemaBuilder;

/**
 * CMS Task Controller
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
class TaskController extends AppController
{
    /**
     * Clears / builds the configuration cache
     *
     * @param CacheInvalidator $invalidator
     * @return void
     */
    public function build(CacheInvalidator $invalidator): void
    {
        $invalidator->clear();

        view()->setPage('apps.cms.view.page.build');
    }

    /**
     * Runs the database migration queries
     *
     * @param ModelSchemaBuilder $scheamBuilder
     * @param ModelMigrator $migrator
     * @return void
     */
    public function migrate(ModelSchemaBuilder $scheamBuilder, ModelMigrator $migrator): void
    {
        $scheamBuilder->run();
        $migrator->run();

        view()->setPage('apps.cms.view.page.migrate');
    }
}
