<?php

namespace Cobra\Mail\Formatter;

use Cobra\Mail\MailerConfig;
use Cobra\Object\AbstractObject;

/**
 * Formatter
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
class Formatter extends AbstractObject
{

    /**
     * MailerConfig instance
     *
     * @var MailerConfig
     */
    protected $config;

    /**
     * Array of config headers
     *
     * @var array
     */
    protected $headers = [];

    /**
     * Sets the requied properties
     *
     * @param MailerConfig $config
     */
    public function __construct(MailerConfig $config)
    {
        $this->config = $config;
    }

    /**
     * Returns an array of formatted email headers
     *
     * @return array
     */
    public function getHeaders(): array
    {
        $this->headers = [];

        $this->headers['To'] = $this->getAddresses($this->config->getTo(), true);
        $this->headers['From'] = $this->config->getFrom();
        $this->headers['Subject'] = $this->config->getSubject();

        $this->headers['Cc'] = $this->getAddresses($this->config->getCc());
        $this->headers['Bcc'] = $this->getAddresses($this->config->getBcc());

        $this->headers['Reply-To'] = $this->config->getReplyTo();
        $this->headers['Return-Path'] = $this->config->getReturnPath();
        
        if ($this->config->getHTML() === true) {
            $this->headers['MIME-Version'] = $this->config->getMimeVersion();
            $this->headers['Content-type'] = $this->getContentType();
        }
        return array_filter(
            array_merge(
                $this->headers,
                $this->config->getHeaders()
            )
        );
    }

    /**
     * Returns a string of formatted email headers
     *
     * @return string
     */
    public function getHeadersString(): string
    {
        $this->headers = $this->getHeaders();

        return implode(
            array_map(
                function ($name, $value) {
                    return sprintf("%s: %s \r\n", $name, $value);
                },
                array_keys($this->headers),
                $this->headers
            )
        );
    }

    /**
     * Returns a string of formatted email addresses
     *
     * @param array $addresses
     * @param boolean $wrap
     * @return string
     */
    public function getAddresses(array $addresses, bool $wrap = false): string
    {
        $addresses = implode(',', $addresses);
        return $wrap === true ? sprintf('<%s>', $addresses) : $addresses;
    }

    /**
     * Returns a formatted content type header string
     *
     * @return string
     */
    public function getContentType(): string
    {
        return sprintf('text/html; charset=%s', $this->config->getCharset());
    }

    /**
     * Returns a formatted string of email headers and body content
     *
     * @return string
     */
    public function getContent(): string
    {
        return sprintf(
            "%s\r\n%s\r\n",
            $this->getHeadersString(),
            $this->config->getBody()
        );
    }
}
