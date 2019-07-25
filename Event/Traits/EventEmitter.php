<?php

namespace Cobra\Event\Traits;

use Cobra\Interfaces\Event\EventHandlerInterface;

/**
 * Event Emitter
 *
 * Trait to fire an application event.
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
trait EventEmitter
{
    /**
     * Emits an event to the handler
     *
     * @param string $event
     * @param array ...$args
     * @return mixed
     */
    public function emit(string $event, &...$args)
    {
        return container_object(EventHandlerInterface::class)->handle($event, ...$args);
    }
}
