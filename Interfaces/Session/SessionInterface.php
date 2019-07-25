<?php

namespace Cobra\Interfaces\Session;

/**
 * Session Interface
 *
 * @category  Session
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
interface SessionInterface
{
    /**
     * Returns the session data array.
     *
     * @return array
     */
    public function data(): array;

    /**
     * Returns a session value.
     *
     * @param  string $name
     * @return void
     */
    public function get(string $name);
}
