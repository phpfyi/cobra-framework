<?php

namespace Cobra\Http\Service;

use Cobra\Core\Service\Service;
use Cobra\Interfaces\Http\Uri\RequestUriInterface;

/**
 * HTTP Service
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
class HttpService extends Service
{
    /**
     * Bind namespace references to classes in the container.
     *
     * @return void
     */
    public function namespaces(): void
    {
        $this
            ->namespace(
                \Cobra\Interfaces\Http\Middleware\MiddlewareHandlerInterface::class,
                \Cobra\Http\Middleware\MiddlewareHandler::class
            );
    }
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

        $uri = $this->app
            ->getRequest()
            ->getUri();
            
        $base = $uri
            ->withPath('')
            ->withQuery('');

        $this
            ->define('URL', $base->withPath($uri->getPath()))
            ->define('URL_PATH', $uri->getPath() == '/' ? '' : $uri->getPath())
            ->define('BASE_URL', $base)
            ->define('BASE_URL_SLASH', $base->withPath('/'))
            ->define('CSS', $base->withPath('/css/'))
            ->define('IMG', $base->withPath('/img/'))
            ->define('JS', $base->withPath('/js/'));
    }

    /**
     * Defines a new constant with an escaped value suitable for output
     * throughout the application
     *
     * @param  string $name
     * @param  string $value
     * @return self
     */
    protected function define(string $name, string $value): self
    {
        define($name, htmlspecialchars($value));
        return $this;
    }
}
