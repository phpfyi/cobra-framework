<?php

namespace Cobra\Mail\Traits;

/**
 * Config From Environment
 *
 * @category  Mail
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
trait ConfigFromEnvironment
{
    /**
     * Sets up the email configuration based off the environment values
     *
     * @return void
     */
    protected function setupConfig(): void
    {
        $config = env('MAILER');
        array_map(
            function ($name, $value) {
                $method = 'set'.ucfirst($name);
                
                $this->{$method}($value);
            },
            array_keys($config),
            $config
        );
    }
}
