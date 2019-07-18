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
     * Array of content security policy rules
     *
     * @var array
     */
    protected $rules = [];

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
        $csp = config('csp');
        array_map(
            function ($name, $values) {
                $rule = sprintf('%s %s%s;', $name, implode(' ', $values), $this->getNonce($name));
                $this->rules[] = $rule;
            },
            array_keys($csp),
            $csp
        );
        return implode(' ', $this->rules);
    }

    /**
     * Returns the CSP nonce token for script execution
     *
     * @param  string $name
     * @return void
     */
    protected function getNonce(string $name)
    {
        if ($name === 'script-src') {
            return sprintf(" 'nonce-%s'", nonce());
        }
    }
}
