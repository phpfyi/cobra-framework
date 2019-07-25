<?php

namespace Cobra\Http\Traits;

use Cobra\Interfaces\Session\SessionInterface;

/**
 * Uses Session Trait
 *
 * Used in both HttpRequest and HttpResponse to facilitate using the request
 * session and writing the new session to the response.
 *
 * The initial session instance is set during app startup through session
 * middleware and assigned to the http request and response instance.
 *
 * Request session data is immutable and new values are only written to the
 * response session and then to $_SESSION.
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
trait UsesSession
{
    /**
     * SessionInterface instance
     *
     * @var SessionInterface
     */
    protected $session;

    /**
     * Sets the session instance.
     *
     * @param  SessionInterface $session
     * @return static
     */
    public function setSession(SessionInterface $session): self
    {
        $this->session = $session;
        return $this;
    }

    /**
     * Returns the session instance.
     *
     * @return SessionInterface
     */
    public function getSession(): SessionInterface
    {
        return $this->session;
    }
}
