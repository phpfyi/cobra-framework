<?php

namespace Cobra\Object;

use Cobra\Config\Traits\Configurable;
use Cobra\Container\Traits\Resolvable;
use Cobra\Interfaces\Object\AbstractObjectInterface;

/**
 * Abstract Object
 *
 * Base class for objects with useful helper methods for resolving dependencies.
 *
 * @category  Object
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class AbstractObject implements AbstractObjectInterface
{
    use Configurable, Resolvable;

    /**
     * Returns a new instance without the calling the container resolver
     *
     * @param  boolean $root
     * @return AbstractObjectInterface
     */
    public static function primitive(bool $root = false): AbstractObjectInterface
    {
        return $root ? new self : new static;
    }
}
