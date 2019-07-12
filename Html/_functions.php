<?php

/**
 * HTML function sets
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

use Cobra\Interfaces\Html\HtmlElementInterface;

if (! function_exists('insert_element')) {
    /**
     * Inserts a HTML element into a list of elements by index
     *
     * @param  HtmlElementInterface $form
     * @param  string      $name
     * @param  HtmlElementInterface $element
     * @param  integer     $index
     * @return void
     */
    function insert_element(
        HtmlElementInterface $parent,
        string $name,
        HtmlElementInterface $element,
        int $index = 0
    ): void {
        $index = array_search(
            $name,
            array_keys($parent->getElements())
        ) + $index;
        
        $parent->setElements(
            array_merge(
                array_slice($parent->getElements(), 0, $index),
                [
                    $element->getName() => $element
                ],
                array_slice($parent->getElements(), $index)
            )
        );
    }
}
