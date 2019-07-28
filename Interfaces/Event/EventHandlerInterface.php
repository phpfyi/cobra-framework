<?php

namespace Cobra\Interfaces\Event;

/**
 * Event Handkler Interface
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
interface EventHandlerInterface
{
    /**
     * Returns an array of all fired events
     *
     * @return array
     */
    public function getFired(): array;

    /**
     * Merges event mappings into the current mappings.
     *
     * @param array $mappings
     * @return EventHandlerInterface
     */
    public function merge(array $mappings): EventHandlerInterface;

    /**
     * Handles the interception of an event and calling the interceptor class.
     *
     * Returns an array of values returned from each event handle method.
     *
     * @param string $event
     * @param array ...$args
     * @return array|null
     */
    public function handle(string $event, &...$args):? array;
}
