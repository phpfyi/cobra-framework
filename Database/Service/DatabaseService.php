<?php

namespace Cobra\Database\Service;

use Cobra\Core\Service\Service;

/**
 * Database Service
 *
 * @category  Database
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class DatabaseService extends Service
{
    /**
     * Bind namespace references to classes in the container.
     *
     * @return void
     */
    public function namespaces(): void
    {
        $this
            ->namespace(
                \Cobra\Interfaces\Database\Relation\HasManyRelationInterface::class,
                \Cobra\Database\Relation\HasManyRelation::class
            )->namespace(
                \Cobra\Interfaces\Database\Relation\HasOneRelationInterface::class,
                \Cobra\Database\Relation\HasOneRelation::class
            )->namespace(
                \Cobra\Interfaces\Database\Relation\ManyManyRelationInterface::class,
                \Cobra\Database\Relation\ManyManyRelation::class
            );
    }
}
