<?php

namespace Cobra\Amp\Html;

use Cobra\Html\HtmlStyleElement;
use Cobra\Html\Traits\RendersFileInBody;

/**
 * AMP Style Element
 *
 * Representation of a AMP <style> element.
 *
 * Loads an external CSS file inline into the body content.
 *
 * @category  AMP
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class AmpStyleElement extends HtmlStyleElement
{
    use RendersFileInBody;

    /**
     * The HTML element tag name
     *
     * @var string
     */
    protected $tag = 'style amp-custom';
}
