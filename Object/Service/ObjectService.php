<?php

namespace Cobra\Object\Service;

use Cobra\Core\Service\Service;

/**
 * Object Service
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
class ObjectService extends Service
{
    /**
     * Bind namespace references to classes in the container.
     *
     * @return void
     */
    public function namespaces(): void
    {
        contain_namespace(
            \Cobra\Interfaces\Object\AbstractObjectInterface::class,
            \Cobra\Object\AbstractObject::class
        );
        contain_namespace(
            \Cobra\Interfaces\Object\Decorator\DecorationHandlerInterface::class,
            \Cobra\Object\Decorator\DecorationHandler::class
        );
        contain_namespace(
            \Cobra\Interfaces\Object\Decorator\ObjectDecoratorInterface::class,
            \Cobra\Object\Decorator\ObjectDecorator::class
        );
        contain_namespace(
            \Cobra\Interfaces\Object\Props\PropsDataInterface::class,
            \Cobra\Object\Props\PropsData::class
        );
    }
}
