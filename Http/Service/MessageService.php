<?php

namespace Cobra\Http\Service;

use Cobra\Core\Service\Service;

/**
 * Message Service
 *
 * @category  HTTP
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class MessageService extends Service
{
    /**
     * Set up any service class instances required by the application.
     *
     * @return void
     */
    public function instances(): void
    {
        contain_object(
            \Cobra\Interfaces\Http\Uri\RequestUriInterface::class,
            $this->app->getRequest()->getUri()
        );
        contain_object(
            \Cobra\Interfaces\Http\Message\RequestInterface::class,
            $this->app->getRequest()
        );
        contain_object(
            \Cobra\Interfaces\Http\Message\ResponseInterface::class,
            $this->app->getResponse()
        );
    }
}
