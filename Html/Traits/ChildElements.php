<?php

namespace Cobra\Html\Traits;

use Cobra\Interfaces\Html\HtmlElementInterface;

/**
 * Child Elements Trait
 *
 * Adds the ability to have a list of child elements within the body of a
 * HTML element. Allows complex nesting of elements.
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
trait ChildElements
{
    /**
     * Array of elements
     *
     * @var array
     */
    protected $elements = [];

    /**
     * Sets a new element or overrides an existing one
     *
     * @param  HtmlElementInterface $element
     * @return HtmlElementInterface
     */
    public function setElement(HtmlElementInterface $element): HtmlElementInterface
    {
        $this->elements[$element->getName()] = $element;
        return $this;
    }

    /**
     * Returns an element instance
     *
     * @param  string $name
     * @return HtmlElementInterface|void
     */
    public function getElement(string $name): HtmlElementInterface
    {
        return $this->elements[$name];
    }

    /**
     * Sets the elements
     *
     * Can be an array of FormElement objects or any sub class of HTML element.
     *
     * @param  array $elements
     * @return HtmlElementInterface
     */
    public function setElements(array $elements): HtmlElementInterface
    {
        $this->elements = $elements;
        return $this;
    }

    /**
     * Returns an array of all forms elements
     *
     * @return array
     */
    public function getElements(): array
    {
        return $this->elements;
    }

    /**
     * Removes an element
     *
     * @param  string $name
     * @return HtmlElementInterface
     */
    public function removeElement(string $name): HtmlElementInterface
    {
        array_key_unset($name, $this->elements);
        return $this;
    }

    /**
     * Removes an array of elements by name
     *
     * @param  array $elements
     * @return HtmlElementInterface
     */
    public function removeElements(array $elements): HtmlElementInterface
    {
        array_keys_unset($elements, $this->elements);
        return $this;
    }

    /**
     * Inserts a HTML element before an element.
     *
     * Can be an element instance or any HTML element sub class.
     *
     * @param  string      $name
     * @param  HtmlElementInterface $element
     * @return HtmlElementInterface
     */
    public function insertBefore(string $name, HtmlElementInterface $element): HtmlElementInterface
    {
        insert_element($this, $name, $element);
        return $this;
    }

    /**
     * Inserts a HTML element after an element.
     *
     * Can be an element instance or any HTML element sub class.
     *
     * @param  string      $name
     * @param  HtmlElementInterface $element
     * @return HtmlElementInterface
     */
    public function insertAfter(string $name, HtmlElementInterface $element): HtmlElementInterface
    {
        insert_element($this, $name, $element, 1);
        return $this;
    }
}
