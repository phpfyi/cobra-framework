<?php

namespace Cobra\Interfaces\Html;

/**
 * HTML interface
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
interface HtmlInterface
{
    /**
     * Render a HTML element instance into a HTML string
     *
     * @param HtmlElementInterface $element
     * @return string
     */
    public static function render(HtmlElementInterface $element): string;
}
