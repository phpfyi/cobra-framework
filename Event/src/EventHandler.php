<?php

namespace Cobra\Event;

use Cobra\Object\AbstractObject;
use Cobra\Interfaces\Event\EventHandlerInterface;

/**
 * Event Handler
 *
 * Handles processing of classes tied to the firing of events.
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
class EventHandler extends AbstractObject implements EventHandlerInterface
{
    /**
     * Array of event mappings
     *
     * @var array
     */
    protected $mappings = [];

    /**
     * Merges event mappings into the current mappings.
     *
     * @param array $mappings
     * @return EventHandlerInterface
     */
    public function merge(array $mappings): EventHandlerInterface
    {
        $this->mappings = array_merge_recursive($this->mappings, $mappings);
        return $this;
    }

    /**
     * Handles the interception of an event and calling the interceptor class.
     *
     * Returns an array of values returned from each event handle method.
     *
     * @param string $event
     * @param array ...$args
     * @return array|null
     */
    public function handle(string $event, &...$args):? array
    {
        if (array_key_exists($event, $this->mappings)) {
            return (array) array_map(function (string $interceptor) use ($args) {
                return $interceptor::resolve()->handle(...$args);
            }, $this->mappings[$event]);
        }
        return null;
    }
}
