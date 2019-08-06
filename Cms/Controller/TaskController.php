<?php

namespace Cobra\Cms\Controller;

use Cobra\Cache\CacheInvalidator;
use Cobra\Cms\Controller\AppController;
use Cobra\Model\Factory\DatabaseArchitect;
use Cobra\Model\Schema\SchemaFactory;

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
     * @param SchemaFactory $schemaFactory
     * @param DatabaseArchitect $databaseArchitect
     * @return void
     */
    public function migrate(SchemaFactory $schemaFactory, DatabaseArchitect $databaseArchitect): void
    {
        $schemaFactory->cacheSchema();
        $databaseArchitect->createDatabase();

        view()
            ->setData('migrated', [])
            ->setPage('apps.cms.view.page.migrate');
    }
}
