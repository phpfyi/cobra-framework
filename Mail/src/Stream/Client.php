<?php

namespace Cobra\Mail\Stream;

use Cobra\Interfaces\Mail\Smtp\SmtpMailerConfigInterface;
use Cobra\Mail\Formatter\Formatter;
use Cobra\Object\AbstractObject;

/**
 * Client
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
class Client extends AbstractObject
{
    /**
     * SmtpMailerConfigInterface instance
     *
     * @var SmtpMailerConfigInterface
     */
    protected $config;

    /**
     * Command instance
     *
     * @var Command
     */
    protected $command;

    /**
     * Socket instance
     *
     * @var Socket
     */
    protected $socket;

    /**
     * Array of status messages
     *
     * @var array
     */
    protected $messages = [];

    /**
     * Sets the required properties
     *
     * @param SmtpMailerConfigInterface $config
     */
    public function __construct(SmtpMailerConfigInterface $config)
    {
        $this->config = $config;
        $this->socket = new Socket(
            $this->config->getRemote(),
            $this->config->getTimeout()
        );
        $this->formatter = new Formatter($this->config);
    }

    /**
     * Returns Command instance
     *
     * @return Command
     */
    public function getCommand(): Command
    {
        return $this->command;
    }

    /**
     * Sets the Socket instance
     *
     * @param  Socket $socket
     * @return Client
     */
    public function setSocket(Socket $socket): Client
    {
        $this->socket = $socket;
        return $this;
    }

    /**
     * Returns Socket instance
     *
     * @return Socket
     */
    public function getSocket(): Socket
    {
        return $this->socket;
    }

    /**
     * Returns an array of messages
     *
     * @return array
     */
    public function getMessages(): Socket
    {
        return $this->messages;
    }

    /**
     * Performs the client request
     *
     * @return boolean
     */
    public function request(): bool
    {
        if (!$this->socket->connect()) {
            return false;
        }
        $this->command = new Command(
            $this->socket->getResource()
        );

        $this->messages['conn'] = $this->command->message();
        $this->messages['hel1'] = $this->command->helo($this->config->getHostname());
        $this->messages['encr'] = $this->command->send($this->config->getEncryption());

        $this->socket->crypto();

        $this->messages['hel2'] = $this->command->helo($this->config->getHostname());
        $this->messages['auth'] = $this->command->send($this->config->getMode());
        $this->messages['user'] = $this->command->encode($this->config->getUsername());
        $this->messages['pass'] = $this->command->encode($this->config->getPassword());

        $this->messages['from'] = $this->command->from($this->config->getFromEmail());
        array_map(
            function ($email) {
                $this->messages['to'][] = $this->command->rcpt($email);
            },
            $this->config->getTo()
        );
        $this->messages['data'] = $this->command->send("DATA");
        $this->messages['body'] = $this->command->send($this->formatter->getContent());
        $this->messages['data'] = $this->command->send(".");
        
        $this->messages['quit'] = $this->command->send("QUIT");
        $this->messages['code'] = substr($this->messages['quit'], 0, 3);
        
        fclose($this->socket->getResource());

        return $this->messages['code'] == 221;
    }
}
