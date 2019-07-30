<?php

namespace Cobra\Interfaces\Core;

use Cobra\Interfaces\Http\Message\ResponseInterface;

/**
 * Kernel interface
 *
 * @category  Core
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
interface KernelInterface
{
    /**
     * Boots the kernel
     *
     * Registers the autoloader and binds it to the container along with the
     * service class namespaces.
     *
     * @return void
     */
    public function boot(): void;

    /**
     * Hands the request over to the application.
     *
     * @return ResponseInterface
     */
    public function handle(): ResponseInterface;

    /**
     * Performs the shutdown sequence.
     *
     * @return void
     */
    public function shutdown(): void;
}
