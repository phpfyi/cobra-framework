<?php

namespace Cobra\Event;

use Cobra\Object\AbstractObject;
use Cobra\Interfaces\Event\EventInterface;

/**
 * Event
 *
 * Base class for application event classes.
 *
 * Sub classes should define a @method handle() which will be passed any
 * arguments passed through @method emit('EventName', $arg1, $arg2...).
 *
 * Additional arguments not passed via emit can be type hinted and will
 * be resolved.
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
abstract class Event extends AbstractObject implements EventInterface
{
    
}
