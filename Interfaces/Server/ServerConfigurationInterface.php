<?php

namespace Cobra\Interfaces\Server;

/**
 * Server Configuration Interface
 *
 * @category  Server
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
interface ServerConfigurationInterface
{
    /**
     * Checks the PHP version is supported
     *
     * Checks that the required PHP extensions are present
     *
     * @return void
     * @throws PhpConfigurationException
     */
    public function verify(): void;
}
