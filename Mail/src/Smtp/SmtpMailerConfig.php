<?php

namespace Cobra\Mail\Smtp;

use Cobra\Interfaces\Mail\Smtp\SmtpMailerConfig as SmtpMailerConfigInterface;
use Cobra\Mail\MailerConfig;

/**
 * SMTP Mailer Config
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
class SmtpMailerConfig extends MailerConfig implements SmtpMailerConfigInterface
{
    /**
     * SMTP hostname
     *
     * @var string
     */
    protected $hostname;

    /**
     * SMTP port
     *
     * @var integer
     */
    protected $port = 587;

    /**
     * SMTP timeout
     *
     * @var integer
     */
    protected $timeout = 10;

    /**
     * SMTP username
     *
     * @var string
     */
    protected $username;

    /**
     * SMTP password
     *
     * @var string
     */
    protected $password;

    /**
     * SMTP encryption
     *
     * @var string
     */
    protected $encryption = 'STARTTLS';

    /**
     * SMTP mode
     *
     * @var string
     */
    protected $mode = 'AUTH LOGIN';

    /**
     * Sets the SMTP hostname
     *
     * @param  string $hostname
     * @return SmtpMailerConfigInterface
     */
    public function setHostname(string $hostname): SmtpMailerConfigInterface
    {
        $this->hostname = $hostname;
        return $this;
    }

    /**
     * Returns the SMTP hostname
     *
     * @return string|null
     */
    public function getHostname():? string
    {
        return $this->hostname;
    }
    
    /**
     * Sets the SMTP port
     *
     * @param  integer $port
     * @return SmtpMailerConfigInterface
     */
    public function setPort(int $port): SmtpMailerConfigInterface
    {
        $this->port = $port;
        return $this;
    }

    /**
     * Returns the SMTP port
     *
     * @return integer
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * Sets the SMTP connection timeout
     *
     * @param  integer $timeout
     * @return SmtpMailerConfigInterface
     */
    public function setTimeout(int $timeout): SmtpMailerConfigInterface
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * Returns the SMTP connection timeout
     *
     * @return integer
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * Sets the SMTP username
     *
     * @param  string $username
     * @return SmtpMailerConfigInterface
     */
    public function setUsername(string $username): SmtpMailerConfigInterface
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Returns the SMTP username
     *
     * @return string|null
     */
    public function getUsername():? string
    {
        return $this->username;
    }
    
    /**
     * Sets the SMTP password
     *
     * @param  string $password
     * @return SmtpMailerConfigInterface
     */
    public function setPassword(string $password): SmtpMailerConfigInterface
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Returns the SMTP password
     *
     * @return string|null
     */
    public function getPassword():? string
    {
        return $this->password;
    }

    /**
     * Sets the SMTP encryption
     *
     * @param  string $encryption
     * @return SmtpMailerConfigInterface
     */
    public function setEncryption(string $encryption): SmtpMailerConfigInterface
    {
        $this->encryption = $encryption;
        return $this;
    }

    /**
     * Returns the SMTP encryption
     *
     * @return string|null
     */
    public function getEncryption():? string
    {
        return $this->encryption;
    }

    /**
     * Sets the SMTP mode
     *
     * @param  string $mode
     * @return SmtpMailerConfigInterface
     */
    public function setMode(string $mode): SmtpMailerConfigInterface
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * Returns the SMTP mode
     *
     * @return string|null
     */
    public function getMode():? string
    {
        return $this->mode;
    }

    /**
     * Returns the remote endpoint
     *
     * @return string
     */
    public function getRemote(): string
    {
        return sprintf(
            '%s:%s',
            $this->hostname,
            $this->port
        );
    }
}
