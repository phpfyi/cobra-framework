<?php

namespace Cobra\Interfaces\Session;

/**
 * Session Manager Interface
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
interface SessionManagerInterface
{
    /**
     * Starts the session.
     *
     * @return void
     */
    public function boot(): void;

    /**
     * Returns the request session.
     *
     * @return SessionInterface
     */
    public function getRequestSession(): SessionInterface;

    /**
     * Returns the response session.
     *
     * @return SessionInterface
     */
    public function getResponseSession(): SessionInterface;
}
