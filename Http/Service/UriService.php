<?php

namespace Cobra\Http\Service;

use Cobra\Interfaces\Http\Uri\RequestUriInterface;
use Cobra\Core\Service\Service;

/**
 * URI Service
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
class UriService extends Service
{
    /**
     * Set up any service class instances required by the application.
     *
     * @param RequestUriInterface $uri
     * @return void
     */
    public function instances(RequestUriInterface $uri): void
    {
        $base = $uri->withPath('')->withQuery('');

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
    public function define(string $name, string $value): self
    {
        define($name, htmlspecialchars($value));
        return $this;
    }
}
