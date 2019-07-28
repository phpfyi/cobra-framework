<?php

namespace Cobra\Mail\Service;

use Cobra\Core\Service\Service;

/**
 * Mail Service
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
class MailService extends Service
{
    /**
     * Bind namespace references to classes in the container.
     *
     * @return void
     */
    public function namespaces(): void
    {
        $this
            ->namespace(
                \Cobra\Interfaces\Mail\MailerInterface::class,
                \Cobra\Mail\Mailer::class
            )->namespace(
                \Cobra\Interfaces\Mail\MailerConfigInterface::class,
                \Cobra\Mail\MailerConfig::class
            )->namespace(
                \Cobra\Interfaces\Mail\Smtp\SmtpMailerInterface::class,
                \Cobra\Mail\Smtp\SmtpMailer::class
            )->namespace(
                \Cobra\Interfaces\Mail\Smtp\SmtpMailerConfigInterface::class,
                \Cobra\Mail\Smtp\SmtpMailerConfig::class
            );
    }
}
