<?php

namespace Cobra\Event\Service;

use Cobra\Core\Service\Service;

/**
 * Event Service
 *
 * @category  Event
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class EventService extends Service
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
                \Cobra\Interfaces\Event\EventInterface::class,
                \Cobra\Event\Event::class
            );
    }

    /**
     * Set up any service class instances required by the application.
     *
     * @return void
     */
    public function instances(): void
    {
        contain_object(
            \Cobra\Interfaces\Event\EventHandlerInterface::class,
            \Cobra\Event\EventHandler::resolve()->merge(
                $this->app->getEvents()
            )
        );
    }
}
