<?php

namespace Cobra\Auth\Event;

use Cobra\Event\Event;
use Cobra\Interfaces\Auth\User\UserLogInterface;
use Cobra\Interfaces\Auth\User\UserInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;

/**
 * Logged In Event
 *
 * @category  Auth
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class LoggedInEvent extends Event
{
    /**
     * Sets the required parameters
     *
     * @param RequestInterface $request
     * @param UserLogInterface $log
     */
    public function __construct(RequestInterface $request, UserLogInterface $log)
    {
        $this->request = $request;
        $this->log = $log;
    }

    /**
     * Writes the user logged in status log
     *
     * @param UserInterface $user
     * @return void
     */
    public function handle(UserInterface $user): void
    {
        $this->log->action = 'Login attempt';
        $this->log->result = 'Success';
        $this->log->ip_address = $this->request->getIP();
        $this->log->save();

        $user->Logs()->add($this->log->id);
    }
}
