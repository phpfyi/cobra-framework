<?php

namespace Cobra\Mail\Smtp;

use Cobra\Interfaces\Mail\Smtp\SmtpMailer as SmtpMailerInterface;
use Cobra\Interfaces\Mail\Smtp\SmtpMailerConfig;
use Cobra\Mail\Mailer;
use Cobra\Mail\Stream\Client;
use Cobra\Mail\Traits\ConfigFromEnvironment;

/**
 * SMTP Mailer
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
class SmtpMailer extends Mailer implements SmtpMailerInterface
{
    use ConfigFromEnvironment;

    /**
     * DataComposer instance
     *
     * @var DataComposer
     */
    protected $composer;

    /**
     * Client instance
     *
     * @var Client
     */
    protected $client;

    /**
     * Sets the requied properties
     *
     * @param SmtpMailerConfig $config
     */
    public function __construct(SmtpMailerConfig $config)
    {
        $this->config = $config;

        $this->setupConfig();

        $this->client = new Client($this->config);
    }

    /**
     * Send the mail through SMTP
     *
     * @return boolean
     */
    public function send(): bool
    {
        return $this->client->request();
    }
}
