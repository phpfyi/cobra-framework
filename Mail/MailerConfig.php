<?php

namespace Cobra\Mail;

use Cobra\Interfaces\Mail\MailerConfigInterface;
use Cobra\Object\AbstractObject;

/**
 * Mailer Config
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
class MailerConfig extends AbstractObject implements MailerConfigInterface
{
    /**
     * To email address
     *
     * @var string
     */
    protected $toEmails = [];

    /**
     * From name
     *
     * @var string
     */
    protected $fromName;

    /**
     * From email
     *
     * @var string
     */
    protected $fromEmail;

    /**
     * Email subject
     *
     * @var string
     */
    protected $subject;

    /**
     * Email body
     *
     * @var string
     */
    protected $body;

    /**
     * Array of email headers
     *
     * @var array
     */
    protected $headers = [];

    /**
     * Array of email carbon copy recipients
     *
     * @var array
     */
    protected $ccEmails = [];

    /**
     * Array of email blind carbon copy recipients
     *
     * @var array
     */
    protected $bccEmails = [];

    /**
     * Reply to email address
     *
     * @var string
     */
    protected $replyTo;

    /**
     * Email bounce return path
     *
     * @var string
     */
    protected $returnPath;

    /**
     * Email charset
     *
     * @var string
     */
    protected $charset = 'iso-8859-1';

    /**
     * Email charset
     *
     * @var string
     */
    protected $mimeVersion = '1.0';

    /**
     * Is HTML email
     *
     * @var boolean
     */
    protected $html = true;

    /**
     * Sets the email recipient
     *
     * @param  string $email
     * @param  string $name
     * @return MailerConfigInterface
     */
    public function setTo(string $email): MailerConfigInterface
    {
        $this->toEmails[] = $email;
        return $this;
    }

    /**
     * Returns the email recipient
     *
     * @return array
     */
    public function getTo(): array
    {
        return $this->toEmails;
    }

    /**
     * Sets the email recipients
     *
     * @param  array $emails
     * @return MailerConfigInterface
     */
    public function setToMany(array $emails): MailerConfigInterface
    {
        $this->toEmails = $emails;
        return $this;
    }

    /**
     * Sets the from name and email
     *
     * @param  string $name
     * @param  string $email
     * @return MailerConfigInterface
     */
    public function setFrom(string $name, string $email): MailerConfigInterface
    {
        $this->fromName = $name;
        $this->fromEmail = $email;
        return $this;
    }

    /**
     * Returns the from name and email
     *
     * @return string
     */
    public function getFrom(): string
    {
        return sprintf('%s <%s>', $this->fromName, $this->fromEmail);
    }

    /**
     * Sets the from name
     *
     * @param  string $name
     * @return MailerConfigInterface
     */
    public function setFromName(string $name): MailerConfigInterface
    {
        $this->fromName = $name;
        return $this;
    }

    /**
     * Returns the from name
     *
     * @return string|null
     */
    public function getFromName():? string
    {
        return $this->fromName;
    }

    /**
     * Sets the from email
     *
     * @param  string $email
     * @return MailerConfigInterface
     */
    public function setFromEmail(string $email): MailerConfigInterface
    {
        $this->fromEmail = $email;
        return $this;
    }

    /**
     * Returns the from email
     *
     * @return string|null
     */
    public function getFromEmail():? string
    {
        return $this->fromEmail;
    }

    /**
     * Sets the email subject
     *
     * @param  string $subject
     * @return MailerConfigInterface
     */
    public function setSubject(string $subject): MailerConfigInterface
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Returns the email subject
     *
     * @return string|null
     */
    public function getSubject():? string
    {
        return $this->subject;
    }

    /**
     * Sets the email body
     *
     * @param  string $body
     * @return MailerConfigInterface
     */
    public function setBody(string $body): MailerConfigInterface
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Returns the email body
     *
     * @return string|null
     */
    public function getBody():? string
    {
        return $this->body;
    }

    /**
     * Sets an email header
     *
     * @param  string $name
     * @param  string $value
     * @return MailerConfigInterface
     */
    public function setHeader(string $name, string $value): MailerConfigInterface
    {
        $this->header[$name] = $value;
        return $this;
    }

    /**
     * Returns an email header
     *
     * @param  string $name
     * @return string|null
     */
    public function getHeader(string $name):? string
    {
        return array_key($name, $this->headers);
    }

    /**
     * Sets an array of email headers
     *
     * @param  array $headers
     * @return MailerConfigInterface
     */
    public function setHeaders(array $headers): MailerConfigInterface
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    /**
     * Returns an array of all email headers
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Set the email carbon copy recipients
     *
     * Seen by other email recipients
     *
     * @param  array $email
     * @return MailerConfigInterface
     */
    public function setCc(array $emails): MailerConfigInterface
    {
        $this->ccEmails = $emails;
        return $this;
    }

    /**
     * Return the email carbon copy recipients
     *
     * @return array
     */
    public function getCc(): array
    {
        return $this->ccEmails;
    }

    /**
     * Sets the email blind carbon copy recipients
     *
     * Not seen by other email recipients
     *
     * @param  array $email
     * @return MailerConfigInterface
     */
    public function setBcc(array $emails): MailerConfigInterface
    {
        $this->bccEmails = $emails;
        return $this;
    }

    /**
     * Returns the email blind carbon copy recipients
     *
     * @return array
     */
    public function getBcc(): array
    {
        return $this->bccEmails;
    }

    /**
     * Sets the reply to email address
     *
     * @param  string $email
     * @return MailerConfigInterface
     */
    public function setReplyTo(string $email): MailerConfigInterface
    {
        $this->replyTo = $email;
        return $this;
    }

    /**
     * Returns the reply to email address
     *
     * @return string|null
     */
    public function getReplyTo():? string
    {
        return $this->replyTo;
    }

    /**
     * Sets the email return path
     *
     * Used for bounces
     *
     * @param  string $email
     * @return MailerConfigInterface
     */
    public function setReturnPath(string $email): MailerConfigInterface
    {
        $this->returnPath = $email;
        return $this;
    }

    /**
     * Returns the email return path
     *
     * @return string|null
     */
    public function getReturnPath():? string
    {
        return $this->returnPath;
    }

    /**
     * Sets the email charset
     *
     * @param  string $charset
     * @return MailerConfigInterface
     */
    public function setCharset(string $charset): MailerConfigInterface
    {
        $this->charset = $charset;
        return $this;
    }

    /**
     * Returns the email charset
     *
     * @return string
     */
    public function getCharset(): string
    {
        return $this->charset;
    }

    /**
     * Sets the email MIME-Version
     *
     * @param  string $version
     * @return MailerConfigInterface
     */
    public function setMimeVersion(string $version): MailerConfigInterface
    {
        $this->mimeVersion = $version;
        return $this;
    }

    /**
     * Returns the email MIME-Version
     *
     * @return string
     */
    public function getMimeVersion(): string
    {
        return $this->mimeVersion;
    }

    /**
     * Sets whether the email is HTML format
     *
     * @param  boolean $html
     * @return MailerConfigInterface
     */
    public function setHTML(bool $html): MailerConfigInterface
    {
        $this->html = $html;
        return $this;
    }

    /**
     * Returns whether the email is HTML format
     *
     * @return boolean
     */
    public function isHTML(): bool
    {
        return $this->html;
    }
}
