<?php

namespace Cobra\Object\Decorator;

use Cobra\Interfaces\Object\Decorator\DecorationHandlerInterface;
use Cobra\Object\AbstractObject;

/**
 * Decoration Handler
 *
 * Decorates a class with extra methods and functionality.
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
class DecorationHandler extends AbstractObject implements DecorationHandlerInterface
{
    /**
     * Passed object to decorate
     *
     * @var object
     */
    protected $object;

    /**
     * Classname of passed object to decorate
     *
     * @var string
     */
    protected $classname;

    /**
     * Array of decorator classes
     *
     * @var array
     */
    protected $decorators = [];

    /**
     * Sets the required properties
     *
     * @param object $object
     * @param string $classname
     */
    public function __construct(object $object, string $classname)
    {
        $this->object = $object;
        $this->classname = $classname;
        $this->decorators = config('object.decorators');
    }

    /**
     * Performs the class decoration which links the decorator classes to this
     * class context.
     *
     * @return void
     */
    public function decorate(): void
    {
        foreach ($this->decorators as $namespace => $decorators) {
            if (is_subclass_of($this->classname, $namespace)) {
                array_map(
                    function ($decorator) {
                        $this->object->setDecorator(
                            $decorator::resolve($this->object)
                        );
                    },
                    $decorators
                );
            }
        }
    }
}
