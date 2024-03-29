<?php

namespace Cobra\Server\Service;

use Cobra\Core\Service\Service;

/**
 * Server Service
 *
 * @category  Server
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class ServerService extends Service
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
                \Cobra\Interfaces\Server\Storage\FileSystemInterface::class,
                \Cobra\Server\Storage\LocalFileSystem::class
            )->namespace(
                \Cobra\Interfaces\Server\ServerInterface::class,
                \Cobra\Server\Server::class
            );
    }
}
