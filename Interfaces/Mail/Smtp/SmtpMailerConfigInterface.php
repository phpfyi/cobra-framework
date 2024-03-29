<?php

namespace Cobra\Interfaces\Mail\Smtp;

/**
 * SMTP Mailer Config Interface
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
interface SmtpMailerConfigInterface
{
    /**
     * Sets the SMTP hostname
     *
     * @param  string $hostname
     * @return SmtpMailerConfigInterface
     */
    public function setHostname(string $hostname): SmtpMailerConfigInterface;
    
    /**
     * Returns the SMTP hostname
     *
     * @return string|null
     */
    public function getHostname():? string;
    
    /**
     * Sets the SMTP port
     *
     * @param  integer $port
     * @return SmtpMailerConfigInterface
     */
    public function setPort(int $port): SmtpMailerConfigInterface;

    /**
     * Returns the SMTP port
     *
     * @return integer
     */
    public function getPort(): int;

    /**
     * Sets the SMTP connection timeout
     *
     * @param  integer $timeout
     * @return SmtpMailerConfigInterface
     */
    public function setTimeout(int $timeout): SmtpMailerConfigInterface;

    /**
     * Returns the SMTP connection timeout
     *
     * @return integer
     */
    public function getTimeout(): int;

    /**
     * Sets the SMTP username
     *
     * @param  string $username
     * @return SmtpMailerConfigInterface
     */
    public function setUsername(string $username): SmtpMailerConfigInterface;

    /**
     * Returns the SMTP username
     *
     * @return string|null
     */
    public function getUsername():? string;
    
    /**
     * Sets the SMTP password
     *
     * @param  string $password
     * @return SmtpMailerConfigInterface
     */
    public function setPassword(string $password): SmtpMailerConfigInterface;

    /**
     * Returns the SMTP password
     *
     * @return string|null
     */
    public function getPassword():? string;

    /**
     * Sets the SMTP encryption
     *
     * @param  string $encryption
     * @return SmtpMailerConfigInterface
     */
    public function setEncryption(string $encryption): SmtpMailerConfigInterface;

    /**
     * Returns the SMTP encryption
     *
     * @return string|null
     */
    public function getEncryption():? string;

    /**
     * Sets the SMTP mode
     *
     * @param  string $mode
     * @return SmtpMailerConfigInterface
     */
    public function setMode(string $mode): SmtpMailerConfigInterface;

    /**
     * Returns the SMTP mode
     *
     * @return string|null
     */
    public function getMode():? string;

    /**
     * Returns the remote endpoint
     *
     * @return string
     */
    public function getRemote(): string;
}
