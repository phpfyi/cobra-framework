<?php

namespace Cobra\Form\Service;

use Cobra\Core\Service\Service;

/**
 * Form Service
 *
 * @category  Form
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class FormService extends Service
{
    /**
     * Bind namespace references to classes in the container.
     *
     * @return void
     */
    public function namespaces(): void
    {
        contain_namespace(
            \Cobra\Interfaces\Form\FormFactoryInterface::class,
            \Cobra\Form\FormFactory::class
        );
        contain_namespace(
            \Cobra\Interfaces\Form\FormInterface::class,
            \Cobra\Form\Form::class
        );
        contain_namespace(
            \Cobra\Interfaces\Form\FormRequestHandlerInterface::class,
            \Cobra\Form\FormRequestHandler::class
        );
        contain_namespace(
            \Cobra\Interfaces\Form\FormRequestInterface::class,
            \Cobra\Form\FormRequest::class
        );
        contain_namespace(
            \Cobra\Interfaces\Form\FormValidatorInterface::class,
            \Cobra\Form\FormValidator::class
        );
    }
}
