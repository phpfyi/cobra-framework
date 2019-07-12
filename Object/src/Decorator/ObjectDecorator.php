<?php

namespace Cobra\Object\Decorator;

use Cobra\Interfaces\Object\Decorator\ObjectDecoratorInterface;
use Cobra\Interfaces\Object\AbstractObjectInterface;
use Cobra\Object\AbstractObject;

/**
 * Object Decorator
 *
 * Proxy-able decorator class which enhances an Object functionality.
 *
 * Acts as a bolt on to a class.
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
class ObjectDecorator extends AbstractObject implements ObjectDecoratorInterface
{
    /**
     * Calling call instance shadow copy
     *
     * @var AbstractObjectInterface
     */
    protected $shadow;

    /**
     * Sets the calling class instance
     *
     * @param AbstractObjectInterface $shadow
     */
    public function __construct(AbstractObjectInterface $shadow)
    {
        $this->shadow = $shadow;
    }
}
