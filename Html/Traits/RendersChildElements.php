<?php

namespace Cobra\Html\Traits;

use Cobra\Html\Html;

/**
 * Renders Child Elements Trait
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
trait RendersChildElements
{
    /**
     * Returns the rendered body content.
     *
     * Redners an array list of HTML child elements into a string into the body.
     *
     * @return string
     */
    public function getBody(): string
    {
        return implode($this->elements);
    }
}
