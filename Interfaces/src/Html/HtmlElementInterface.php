<?php

namespace Cobra\Interfaces\Html;

/**
 * HTML Element interface
 *
 * @category  HTML
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
interface HtmlElementInterface
{
    /**
     * Sets the HTML element tag
     *
     * @param  string $tag
     * @return HtmlElementInterface
     */
    public function setTag(string $tag): HtmlElementInterface;

    /**
     * Returns the HTML element tag
     *
     * @return string
     */
    public function getTag(): string;

    /**
     * Sets the tag identifier
     *
     * @param  string $name
     * @return HtmlElementInterface
     */
    public function setName(string $name): HtmlElementInterface;

    /**
     * Returns the tag identifier
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Set a HTML attribute
     *
     * @param  string     $name
     * @param  string|int $value
     * @return HtmlElementInterface
     */
    public function setAttribute(string $name, $value): HtmlElementInterface;

    /**
     * Set multiple HTML attributes merged into the current attribute array
     *
     * @param  array $attributes
     * @return HtmlElementInterface
     */
    public function setAttributes(array $attributes): HtmlElementInterface;

    /**
     * Returns all set HTML attributes
     *
     * @return array
     */
    public function getAttributes(): array;

    /**
     * Adds a CSS class to the current list of CSS classes
     *
     * @param  string $class
     * @return HtmlElementInterface
     */
    public function addClass(string $class): HtmlElementInterface;

    /**
     * Sets the HTML element ID attribute
     *
     * @param  string $id
     * @return HtmlElementInterface
     */
    public function setID(string $id): HtmlElementInterface;

    /**
     * Returns the HTML element ID attribute
     *
     * @return string
     */
    public function getID(): string;

    /**
     * Sets the HTML element body content
     *
     * @param  string|null $body
     * @return HtmlElementInterface
     */
    public function setBody(?string $body): HtmlElementInterface;

    /**
     * Returns the HTML element body content
     *
     * @return string
     */
    public function getBody(): string;

    /**
     * Set whether this element has a closing tag
     *
     * @param  boolean $close
     * @return HtmlElementInterface
     */
    public function setClose(bool $close): HtmlElementInterface;

    /**
     * Returns whether the HTML element closes
     *
     * @return bool
     */
    public function hasClose(): bool;

    /**
     * Set the HTML content before the HTML element
     *
     * @param  string $content
     * @return HtmlElementInterface
     */
    public function setBefore(string $content): HtmlElementInterface;

    /**
     * Returns the HTML content before this HTML ekement
     *
     * @return string|null
     */
    public function getBefore():? string;

    /**
     * Set the HTML content after the HTML element
     *
     * @param  string $content
     * @return HtmlElementInterface
     */
    public function setAfter(string $content): HtmlElementInterface;

    /**
     * Returns the HTML content after this HTML element
     *
     * @return string|null
     */
    public function getAfter():? string;
}
