<?php

use Cobra\Interfaces\Security\Token\CsrfTokenInterface;
use Cobra\Interfaces\Security\Token\NonceTokenInterface;

if (! function_exists('nonce')) {
    /**
     * Returns the nonce token
     *
     * @return string
     */
    function nonce(): string
    {
        return container_object(NonceTokenInterface::class)::get();
    }
}

if (! function_exists('csrf')) {
    /**
     * Returns the csrf token
     *
     * @return string
     */
    function csrf(): string
    {
        return container_object(CsrfTokenInterface::class)::get();
    }
}
