<?php

namespace Cobra\Interfaces\View\Asset;

use Cobra\Interfaces\Html\HtmlElementInterface;
use Cobra\Html\HtmlLinkElement;
use Cobra\Html\HtmlMetaElement;

/**
 * View Meta Interface
 *
 * @category  View
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
interface ViewMetaInterface
{
    /**
     * Sets a meta base HTML tag
     *
     * @param  string $href
     * @param  array  $attributes
     * @return HtmlElementInterface
     */
    public function setBaseTag(string $href, $attributes = []): HtmlElementInterface;

    /**
     * Sets a meta charset HTML tag
     *
     * @param  string $encoding
     * @param  array  $attributes
     * @return HtmlElementInterface
     */
    public function setCharset(string $encoding, $attributes = []): HtmlElementInterface;

    /**
     * Sets a meta title HTML tag
     *
     * @param  string $text
     * @param  array  $attributes
     * @return HtmlElementInterface
     */
    public function setTitle(?string $text, $attributes = []): HtmlElementInterface;

    /**
     * Sets a meta link HTML tag
     *
     * @param  string $rel
     * @param  string $href
     * @param  array  $attributes
     * @return HtmlLinkElement
     */
    public function setLink(string $rel, string $href, $attributes = []): HtmlLinkElement;

    /**
     * Sets a meta HTML tag
     *
     * @param  string      $name
     * @param  string|null $content
     * @param  array       $attributes
     * @return HtmlMetaElement
     */
    public function setTag(string $name, ?string $content, $attributes = []): HtmlMetaElement;

    /**
     * Sets a meta property HTML tag
     *
     * @param  string      $property
     * @param  string|null $content
     * @param  array       $attributes
     * @return HtmlMetaElement
     */
    public function setPropertyTag(string $property, ?string $content, $attributes = []): HtmlMetaElement;
}
