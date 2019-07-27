<?php

namespace Cobra\Auth\Password;

use Cobra\Html\HtmlElement;
use Cobra\View\Traits\RendersTemplate;
use Cobra\Interfaces\View\ViewObject;

/**
 * Password Validation HTML Element
 *
 * @category  Auth
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class PasswordValidationHtmlElement extends HtmlElement implements ViewObject
{
    use RendersTemplate;

    /**
     * The HTML element tag name
     *
     * @var string
     */
    protected $tag = 'div';

    /**
     * Template to render the form field in
     *
     * @var string
     */
    protected $template = 'templates.Security.PasswordValidationHtmlElement';

    /**
     * Sets up the HTML tag with tag name and close properties
     *
     * @param string $name
     */
    public function __construct($name = null)
    {
        parent::__construct('div', $name);
    }

    /**
     * Returns an array of view data
     *
     * @return array
     */
    public function getViewData(): array
    {
        return [];
    }
}
