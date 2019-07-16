<?php

namespace Cobra\Interfaces\Mail;

use Cobra\Interfaces\Mail\MailerConfig;

/**
 * Mailer interface
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
interface Mailer
{
    /**
     * Sets the MailerConfig instance
     *
     * @param  MailerConfig $email
     * @return Mailer
     */
    public function setConfig(MailerConfig $config): Mailer;

    /**
     * Returns the MailerConfig instance
     *
     * @return MailerConfig
     */
    public function getConfig(): MailerConfig;
}
