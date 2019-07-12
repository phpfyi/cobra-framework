<?php

namespace Cobra\Object\Traits;

use BadMethodCallException;
use Cobra\Interfaces\Object\Decorator\ObjectDecoratorInterface;
use Cobra\Object\Decorator\DecorationHandler;

/**
 * Decoratable trait
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
trait Decoratable
{
    /**
     * Whether the current class has been decorated
     *
     * @var array
     */
    private $decorated = false;

    /**
     * Array of decorator classes
     *
     * @var array
     */
    private $decorators = [];

    /**
     * Proxy for decorator classes which allows calling the decorator class
     * method in the current object context
     *
     * @throws BadMethodCallException
     * @param  string $name
     * @param  array  $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        if (is_callable(['parent', '__call'])) {
            parent::__call($name, $arguments);
        }
        if ($this->decorated === false) {
            DecorationHandler::resolve($this, static::class)->decorate();
            $this->decorated = true;
        }
        foreach ($this->decorators as $decorator) {
            if (method_exists($decorator, $name)) {
                return call_user_func_array([$decorator, $name], $arguments);
            }
        }
        throw new BadMethodCallException(
            sprintf('Method %s does not exist on %s', $name, static::class)
        );
    }

    /**
     * Sets a decorator class on this object
     *
     * @param ObjectDecoratorInterface $decorator
     * @return object
     */
    public function setDecorator(ObjectDecoratorInterface $decorator): object
    {
        $this->decorators[get_class($decorator)] = $decorator;
        return $this;
    }
}
