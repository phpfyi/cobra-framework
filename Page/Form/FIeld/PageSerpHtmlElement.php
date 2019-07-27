<?php

namespace Cobra\Page\Form\Field;

use Cobra\Html\HtmlElement;
use Cobra\Interfaces\View\ViewObject;
use Cobra\View\Traits\RendersTemplate;

/**
 * Page SERP HTML Element
 *
 * @category  Page
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class PageSerpHtmlElement extends HtmlElement implements ViewObject
{
    use RendersTemplate;

    /**
     * The HTML element tag name
     *
     * @var string
     */
    protected $tag = 'div';

    /**
     * SERP preview URI
     *
     * @var string
     */
    protected $uri;

    /**
     * Template to render the form field in
     *
     * @var string
     */
    protected $template = 'templates.Page.PageSerpHtmlElement';

    /**
     * Sets up the HTML tag with tag name and close properties
     *
     * @param string $tag
     * @param string $name
     */
    public function __construct($tag = null, $name = null)
    {
        parent::__construct($tag, $name);
    }

    /**
     * Sets the SERP preview URI.
     *
     * @param  string|null $uri
     * @return PageSerpHtmlElement
     */
    public function setUri(?string $uri): PageSerpHtmlElement
    {
        $this->uri = $uri;
        return $this;
    }
    
    /**
     * Returns the SERP preview URI.
     *
     * @return string|null
     */
    public function getUri():? string
    {
        return $this->uri;
    }

    /**
     * Returns an array of view data
     *
     * @return array
     */
    public function getViewData(): array
    {
        return [
            'uri' => $this->getUri()
        ];
    }
}
