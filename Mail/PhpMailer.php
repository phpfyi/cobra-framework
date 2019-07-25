<?php

namespace Cobra\Mail;

use Cobra\Interfaces\Mail\MailerConfigInterface;
use Cobra\Mail\Formatter\Formatter;
use Cobra\Mail\Mailer;
use Cobra\Mail\Traits\ConfigFromEnvironment;

/**
 * PHP Mailer
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
class PhpMailer extends Mailer
{
    use ConfigFromEnvironment;

    /**
     * Formatter instance
     *
     * @var Formatter
     */
    protected $formatter;

    /**
     * Sets the requied properties
     *
     * @param MailerConfigInterface $config
     */
    public function __construct(MailerConfigInterface $config)
    {
        $this->config = $config;

        $this->setupConfig();

        $this->formatter = new Formatter($this->config);
    }

    /**
     * Send the mail through the native PHP mail function
     *
     * @return boolean
     */
    public function send(): bool
    {
        return mail(
            $this->formatter->getAddresses($this->config->getTo()),
            $this->subject,
            $this->body,
            $this->formatter->getHeadersString()
        );
    }
}
