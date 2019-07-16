<?php

namespace Cobra\Mail;

use BadMethodCallException;
use Cobra\Interfaces\Mail\MailerInterface;
use Cobra\Interfaces\Mail\MailerConfigInterface;
use Cobra\Object\AbstractObject;

/**
 * Mailer
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
abstract class Mailer extends AbstractObject implements MailerInterface
{
    /**
     * MailerConfigInterface instance
     *
     * @var MailerConfigInterface
     */
    protected $config;

    /**
     * Send the mail
     *
     * @return boolean
     */
    abstract public function send(): bool;
    
    /**
     * Sets the MailerConfig instance
     *
     * @param  MailerConfigInterface $email
     * @return MailerInterface
     */
    public function setConfig(MailerConfigInterface $config): MailerInterface
    {
        $this->config = $config;
        return $this;
    }

    /**
     * Returns the MailerConfig instance
     *
     * @return MailerConfigInterface
     */
    public function getConfig(): MailerConfigInterface
    {
        return $this->config;
    }

    /**
     * Proxy to set config values
     *
     * @param string $name
     * @param array $arguments
     * @return MailerInterface
     * @throws BadMethodCallException
     */
    public function __call(string $name, array $arguments): MailerInterface
    {
        if (method_exists($this->config, $name)) {
            $this->config->{$name}(...$arguments);
            return $this;
        }
        throw new BadMethodCallException(
            sprintf('Cannot find mailer config method: %s', $name)
        );
    }
}
