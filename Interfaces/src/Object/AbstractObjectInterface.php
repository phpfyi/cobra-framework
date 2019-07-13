<?php

namespace Cobra\Interfaces\Object;

/**
 * Abstract Object interface
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
interface AbstractObjectInterface
{
    /**
     * Returns a new instance without the calling the container resolver
     *
     * @param  boolean $root
     * @return AbstractObjectInterface
     */
    public static function primitive(bool $root = false): AbstractObjectInterface;
}
