<?php

namespace Cobra\Interfaces\Mail\Smtp;

/**
 * SMTP Mailer Config interface
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
interface SmtpMailerConfig
{
    /**
     * Sets the SMTP hostname
     *
     * @param  string $hostname
     * @return SmtpMailerConfig
     */
    public function setHostname(string $hostname): SmtpMailerConfig;
    
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
     * @return SmtpMailerConfig
     */
    public function setPort(int $port): SmtpMailerConfig;

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
     * @return SmtpMailerConfig
     */
    public function setTimeout(int $timeout): SmtpMailerConfig;

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
     * @return SmtpMailerConfig
     */
    public function setUsername(string $username): SmtpMailerConfig;

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
     * @return SmtpMailerConfig
     */
    public function setPassword(string $password): SmtpMailerConfig;

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
     * @return SmtpMailerConfig
     */
    public function setEncryption(string $encryption): SmtpMailerConfig;

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
     * @return SmtpMailerConfig
     */
    public function setMode(string $mode): SmtpMailerConfig;

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
