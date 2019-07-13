<?php

namespace Cobra\Interfaces\Object\Decorator;

/**
 * Decoration Handler Interface
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
interface DecorationHandlerInterface
{
    /**
     * Performs the class decoration which links the decorator classes to this
     * class context.
     *
     * @return void
     */
    public function decorate(): void;
}
