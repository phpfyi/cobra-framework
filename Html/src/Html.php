<?php

namespace Cobra\Html;

use Cobra\Interfaces\Html\HtmlInterface;
use Cobra\Interfaces\Html\HtmlElementInterface;

/**
 * Html
 *
 * Utility class for dealing with HTML
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
class Html implements HtmlInterface
{
    /**
     * Render a HTML element instance into a HTML string
     *
     * @param HtmlElementInterface $element
     * @return string
     */
    public static function render(HtmlElementInterface $element): string
    {
        $attributes = count($element->getAttributes()) == 0 ? '' : ' '.implode(
            array_map(
                function ($key, $value) {
                    return sprintf('%s="%s"', $key, $value);
                },
                array_keys($element->getAttributes()),
                $element->getAttributes()
            )
        );
        return sprintf(
            '%s<%s%s>%s%s%s',
            $element->getBefore(),
            $element->getTag(),
            $attributes,
            $element->getBody(),
            $element->getClose() === true ? sprintf('</%s>', $element->getTag()) : '',
            $element->getAfter()
        ).PHP_EOL;
    }
}
