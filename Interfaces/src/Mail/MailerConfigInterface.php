<?php

namespace Cobra\Interfaces\Mail;

/**
 * Mailer Config interface
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
interface MailerConfigInterface
{
    /**
     * Sets the email recipient
     *
     * @param  string $email
     * @param  string $name
     * @return MailerConfigInterface
     */
    public function setTo(string $email): MailerConfigInterface;

    /**
     * Returns the email recipient
     *
     * @return array
     */
    public function getTo(): array;

    /**
     * Sets the email recipients
     *
     * @param  array $emails
     * @return MailerConfigInterface
     */
    public function setToMany(array $emails): MailerConfigInterface;

    /**
     * Sets the from name and email
     *
     * @param  string $name
     * @param  string $email
     * @return MailerConfigInterface
     */
    public function setFrom(string $name, string $email): MailerConfigInterface;

    /**
     * Returns the from name and email
     *
     * @return string
     */
    public function getFrom(): string;

    /**
     * Sets the from name
     *
     * @param  string $name
     * @return MailerConfigInterface
     */
    public function setFromName(string $name): MailerConfigInterface;

    /**
     * Returns the from name
     *
     * @return string|null
     */
    public function getFromName():? string;

    /**
     * Sets the from email
     *
     * @param  string $email
     * @return MailerConfigInterface
     */
    public function setFromEmail(string $email): MailerConfigInterface;

    /**
     * Returns the from email
     *
     * @return string|null
     */
    public function getFromEmail():? string;

    /**
     * Sets the email subject
     *
     * @param  string $subject
     * @return MailerConfigInterface
     */
    public function setSubject(string $subject): MailerConfigInterface;

    /**
     * Returns the email subject
     *
     * @return string|null
     */
    public function getSubject():? string;

    /**
     * Sets the email body
     *
     * @param  string $body
     * @return MailerConfigInterface
     */
    public function setBody(string $body): MailerConfigInterface;

    /**
     * Returns the email body
     *
     * @return string|null
     */
    public function getBody():? string;

    /**
     * Sets an email header
     *
     * @param  string $name
     * @param  string $value
     * @return MailerConfigInterface
     */
    public function setHeader(string $name, string $value): MailerConfigInterface;

    /**
     * Returns an email header
     *
     * @param  string $name
     * @return string|null
     */
    public function getHeader(string $name):? string;

    /**
     * Sets an array of email headers
     *
     * @param  array $headers
     * @return MailerConfigInterface
     */
    public function setHeaders(array $headers): MailerConfigInterface;

    /**
     * Returns an array of all email headers
     *
     * @return array
     */
    public function getHeaders(): array;

    /**
     * Set the email carbon copy recipients
     *
     * Seen by other email recipients
     *
     * @param  array $email
     * @return MailerConfigInterface
     */
    public function setCc(array $emails): MailerConfigInterface;

    /**
     * Return the email carbon copy recipients
     *
     * @return array
     */
    public function getCc(): array;

    /**
     * Sets the email blind carbon copy recipients
     *
     * Not seen by other email recipients
     *
     * @param  array $email
     * @return MailerConfigInterface
     */
    public function setBcc(array $emails): MailerConfigInterface;

    /**
     * Returns the email blind carbon copy recipients
     *
     * @return array
     */
    public function getBcc(): array;

    /**
     * Sets the reply to email address
     *
     * @param  string $email
     * @return MailerConfigInterface
     */
    public function setReplyTo(string $email): MailerConfigInterface;

    /**
     * Returns the reply to email address
     *
     * @return string|null
     */
    public function getReplyTo():? string;

    /**
     * Sets the email return path
     *
     * Used for bounces
     *
     * @param  string $email
     * @return MailerConfigInterface
     */
    public function setReturnPath(string $email): MailerConfigInterface;

    /**
     * Returns the email return path
     *
     * @return string|null
     */
    public function getReturnPath():? string;

    /**
     * Sets the email charset
     *
     * @param  string $charset
     * @return MailerConfigInterface
     */
    public function setCharset(string $charset): MailerConfigInterface;

    /**
     * Returns the email charset
     *
     * @return string
     */
    public function getCharset(): string;

    /**
     * Sets the email MIME-Version
     *
     * @param  string $version
     * @return MailerConfigInterface
     */
    public function setMimeVersion(string $version): MailerConfigInterface;

    /**
     * Returns the email MIME-Version
     *
     * @return string
     */
    public function getMimeVersion(): string;

    /**
     * Sets whether the email is HTML format
     *
     * @param  boolean $html
     * @return MailerConfigInterface
     */
    public function setHTML(bool $html): MailerConfigInterface;

    /**
     * Returns whether the email is HTML format
     *
     * @return boolean
     */
    public function getHTML(): bool;
}
