<?php

namespace Cobra\Interfaces\Mail;

use Cobra\Interfaces\Mail\MailerConfigInterface;

/**
 * Mailer Interface
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
interface MailerInterface
{
    /**
     * Sets the MailerConfigInterface instance
     *
     * @param  MailerConfigInterface $email
     * @return MailerInterface
     */
    public function setConfig(MailerConfigInterface $config): MailerInterface;

    /**
     * Returns the MailerConfig instance
     *
     * @return MailerConfigInterface
     */
    public function getConfig(): MailerConfigInterface;
}
