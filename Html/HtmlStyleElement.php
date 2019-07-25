<?php

namespace Cobra\Html;

use Cobra\Html\HtmlElement;
use Cobra\Html\Traits\RendersFileInBody;

/**
 * Html Style Element
 *
 * Representation of a HTML <style> element
 * Can load an external file into the body content for inline CSS
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
class HtmlStyleElement extends HtmlElement
{
    use RendersFileInBody;

    /**
     * The HTML element tag name
     *
     * @var string
     */
    protected $tag = 'style';
}
