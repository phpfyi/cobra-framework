<?php

namespace Cobra\Html;

use Cobra\Interfaces\Html\HtmlElementInterface;
use Cobra\Html\Traits\RendersAsHtml;
use Cobra\Object\AbstractObject;

/**
 * HTML Element
 *
 * Base HTML element class.
 *
 * This is a versatile and generic class that can be easily subclassed to create
 * any sort of HTML element by expanding on the current properties and methods.
 *
 * Using the setBefore and setAfter methods allows complex wrapping of the HTML
 * element either with other HTML elements or other text content.
 *
 * Casting this class object to a string will render the HTML element from the
 * __toString method.
 *
 * Subclasses can override the __toString method to render a template instead
 * of just the element HTML.
 *
 * For more complex implmentations see Form HTML elements or Meta based elements
 * which use different types of body content and template loading.
 *
 * The HTML element interface should be used as a type hint in methods where
 * possible even if the passed property object is a subclass of HTML element.
 * Following this pattern will give greater flexibility when working with HTML
 * elements and their subclasses.
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
class HtmlElement extends AbstractObject implements HtmlElementInterface
{
    use RendersAsHtml;

    /**
     * The HTML element tag name
     *
     * @var string
     */
    protected $tag;

    /**
     * An identifier used for the tag
     *
     * @var string
     */
    protected $name = '';

    /**
     * Associative array of HTML element attributes
     *
     * Takes the format [attribute] => [value]
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * HTML element body content
     *
     * @var string
     */
    protected $body;

    /**
     * Whether this element has a closing tag
     *
     * @var boolean
     */
    protected $close = true;

    /**
     * HTML content before this element
     *
     * @var string
     */
    protected $before;

    /**
     * HTML content after this element
     *
     * @var string
     */
    protected $after;

    /**
     * Sets up the HTML tag, name, and body properties
     *
     * @param string $tag
     * @param string $name
     * @param string $body
     */
    public function __construct(string $tag = null, string $name = null, string $body = null)
    {
        $this->tag = $tag ?? $this->tag;
        $this->name = $name ?? $this->name;
        $this->body = $body;
    }
    
    /**
     * Sets the HTML element tag
     *
     * @param  string $tag
     * @return HtmlElementInterface
     */
    public function setTag(string $tag): HtmlElementInterface
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * Returns the HTML element tag
     *
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * Sets the tag identifier
     *
     * @param  string $name
     * @return HtmlElementInterface
     */
    public function setName(string $name): HtmlElementInterface
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the tag identifier
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set a HTML attribute
     *
     * @param  string     $name
     * @param  string|int $value
     * @return HtmlElementInterface
     */
    public function setAttribute(string $name, $value): HtmlElementInterface
    {
        $this->attributes[$name] = (string) $value;
        return $this;
    }

    /**
     * Set multiple HTML attributes merged into the current attribute array
     *
     * @param  array $attributes
     * @return HtmlElementInterface
     */
    public function setAttributes(array $attributes): HtmlElementInterface
    {
        $this->attributes = array_merge($this->attributes, $attributes);
        return $this;
    }

    /**
     * Returns all set HTML attributes
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Adds a CSS class to the current list of CSS classes
     *
     * @param  string $class
     * @return HtmlElementInterface
     */
    public function addClass(string $class): HtmlElementInterface
    {
        $this->attributes['class'] = array_key_exists('class', $this->attributes)
        ? sprintf('%s %s', $this->attributes['class'], $class)
        : $class;
        return $this;
    }

    /**
     * Sets the HTML element ID attribute
     *
     * @param  string $elementId
     * @return HtmlElementInterface
     */
    public function setID(string $elementId): HtmlElementInterface
    {
        $this->attributes['id'] = $elementId;
    }

    /**
     * Returns the HTML element ID attribute
     *
     * @return string
     */
    public function getID(): string
    {
        return $this->attributes['id'];
    }

    /**
     * Sets the HTML element body content
     *
     * @param  string|null $body
     * @return HtmlElementInterface
     */
    public function setBody(?string $body): HtmlElementInterface
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Returns the HTML element body content
     *
     * @return string
     */
    public function getBody(): string
    {
        return (string) $this->body;
    }

    /**
     * Set whether this element has a closing tag
     *
     * @param  boolean $close
     * @return HtmlElementInterface
     */
    public function setClose(bool $close): HtmlElementInterface
    {
        $this->close = $close;
        return $this;
    }

    /**
     * Returns whether the HTML element closes
     *
     * @return bool
     */
    public function hasClose(): bool
    {
        return $this->close;
    }

    /**
     * Set the HTML content before the HTML element
     *
     * @param  string $content
     * @return HtmlElementInterface
     */
    public function setBefore(string $content): HtmlElementInterface
    {
        $this->before = $content;
        return $this;
    }

    /**
     * Returns the HTML content before this HTML ekement
     *
     * @return string|null
     */
    public function getBefore():? string
    {
        return $this->before;
    }

    /**
     * Set the HTML content after the HTML element
     *
     * @param  string $content
     * @return HtmlElementInterface
     */
    public function setAfter(string $content): HtmlElementInterface
    {
        $this->after = $content;
        return $this;
    }

    /**
     * Returns the HTML content after this HTML element
     *
     * @return string|null
     */
    public function getAfter():? string
    {
        return $this->after;
    }
}
