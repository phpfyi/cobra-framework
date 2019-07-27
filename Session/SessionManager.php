<?php

namespace Cobra\Session;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Session\SessionInterface;
use Cobra\Interfaces\Session\SessionManagerInterface;
use Cobra\Object\AbstractObject;
use Cobra\Session\Traits\SessionActions;

/**
 * Session Manager
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
class SessionManager extends AbstractObject implements SessionManagerInterface
{
    use SessionActions;

    /**
     * Array of session data
     *
     * @var array
     */
    protected $data = [];

    /**
     * HTTP Request instance
     *
     * @var RequestInterface
     */
    protected $request;

    /**
     * Session regenerate ID chance
     *
     * @var integer
     */
    protected $chance = 0;

    /**
     * Sets up the session configuration.
     *
     * @param RequestInterface $request
     * @param integer          $chance
     * @param string           $name
     * @param integer          $lifetime
     * @param string           $path
     * @param string           $domain
     * @param boolean          $secure
     * @param boolean          $http
     */
    public function __construct(
        RequestInterface $request,
        int $chance,
        string $name,
        int $lifetime,
        string $path,
        string $domain,
        bool $secure,
        bool $http
    ) {
        $this->request = $request;
        $this->chance = $chance;

        session_set_cookie_params($lifetime, $path, $domain, $secure, $http);
        
        session_name($name);
    }

    /**
     * Starts the session.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->start();

        $this->data = is_array($_SESSION) ? $_SESSION : [];
        $this->requestSession = RequestSession::resolve($this->request, $this->data);
        $this->responseSession = ResponseSession::resolve($this->request, $this->data);

        if (!$this->hasUserParams()) {
            $this->data = [];
            $this->write();

            $this->responseSession->setAll([]);
            $this->responseSession->set(
                'ip_address',
                $this->request->getServerParam('REMOTE_ADDR')
            );
            $this->responseSession->set(
                'user_agent',
                $this->request->getServerParam('HTTP_USER_AGENT')
            );
            $this->regenerate();
        } elseif (rand(1, 100) <= $this->chance) {
            $this->regenerate();
        }
    }

    /**
     * Returns the request session.
     *
     * @return SessionInterface
     */
    public function getRequestSession(): SessionInterface
    {
        return $this->requestSession;
    }

    /**
     * Returns the response session.
     *
     * @return SessionInterface
     */
    public function getResponseSession(): SessionInterface
    {
        return $this->responseSession;
    }

    /**
     * Checks the session for user IP and user agent.
     *
     * @return boolean
     */
    protected function hasUserParams(): bool
    {
        if (!array_key_exists('ip_address', $this->data)) {
            return false;
        }
        if (!array_key_exists('user_agent', $this->data)) {
            return false;
        }
        if ($this->request->getServerParam('REMOTE_ADDR') !== $this->data['ip_address']) {
            return false;
        }
        if ($this->request->getServerParam('HTTP_USER_AGENT') !== $this->data['user_agent']) {
            return false;
        }
        return true;
    }
}
