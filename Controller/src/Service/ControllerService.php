<?php

namespace Cobra\Controller\Service;

use Cobra\Core\Service\Service;

/**
 * Controller Service
 *
 * @category  Controller
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class ControllerService extends Service
{
    /**
     * Bind namespace references to classes in the container.
     *
     * @return void
     */
    public function namespaces(): void
    {
        contain_namespace(
            \Cobra\Interfaces\Controller\ControllerActionHandlerInterface::class,
            \Cobra\Controller\ControllerActionHandler::class
        );
        contain_namespace(
            \Cobra\Interfaces\Controller\ControllerDirectorInterface::class,
            \Cobra\Controller\ControllerDirector::class
        );
    }
}
