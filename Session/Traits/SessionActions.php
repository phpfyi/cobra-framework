<?php

namespace Cobra\Session\Traits;

/**
 * Session Actions Trait
 *
 * Set of methods that allow modifying of session data.
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
trait SessionActions
{
    /**
     * Array of session data.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Regenerates the session ID.
     *
     * @param  boolean $delete
     * @return void
     */
    public function regenerate($delete = false): void
    {
        session_regenerate_id($delete);
    }

    /**
     * Writes the session data array and restarts the session,
     *
     * @return void
     */
    public function write(): void
    {
        $_SESSION = $this->data;
        
        session_write_close();
        session_start();
    }

    /**
     * Resets the session data array.
     *
     * @return void
     */
    public function reset(): void
    {
        $this->data = [];
    }
    
    /**
     * Destroys the current session.
     *
     * @return void
     */
    public function destroy(): void
    {
        $this->data = [];

        session_unset();
        session_destroy();
        session_start();
        
        $this->regenerate(true);
    }
}
