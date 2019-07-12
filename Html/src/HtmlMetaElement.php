<?php

namespace Cobra\Html;

/**
 * Html Meta Element
 *
 * Representation of a HTML <meta> element
 *
 * @category  Html
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class HtmlMetaElement extends HtmlElement
{
    /**
     * The HTML element tag name
     *
     * @var string
     */
    protected $tag = 'meta';

    /**
     * Whether this element has a closing tag
     *
     * @var boolean
     */
    protected $close = false;
}
