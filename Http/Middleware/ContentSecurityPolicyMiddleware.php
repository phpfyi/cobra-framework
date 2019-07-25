<?php

namespace Cobra\Http\Middleware;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Http\RequestHandlerInterface;

/**
 * Content Security Policy Middleware
 *
 * CSP handler
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
class ContentSecurityPolicyMiddleware extends Middleware
{
    /**
     * Enables the content security policy header
     *
     * @param  RequestInterface  $request
     * @param  RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $handler->getResponse()->addHeader('Content-Security-Policy', $this->getRules());

        return $handler->handle($request);
    }

    /**
     * Returns the formatted header content security policy rules
     *
     * @return string
     */
    protected function getRules(): string
    {
        $csp = (array) config('csp');
        return implode(
            ' ',
            array_map(
                function ($name, $values) {
                    return sprintf(
                        '%s %s%s;',
                        $name,
                        implode(' ', $values),
                        $this->getNonce($name)
                    );
                },
                array_keys($csp),
                $csp
            )
        );
    }

    /**
     * Returns the CSP nonce token for script execution
     *
     * @param  string $name
     * @return string
     */
    protected function getNonce(string $name): string
    {
        return $name === 'script-src'
        ? sprintf(" 'nonce-%s'", nonce())
        : '';
    }
}
