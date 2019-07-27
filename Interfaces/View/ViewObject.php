<?php

namespace Cobra\Interfaces\View;

/**
 * View interface
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
interface ViewObject
{
    /**
     * Returns an array of view data
     *
     * @return array
     */
    public function getViewData(): array;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getHTML();
    
    /**
     * Returns the rendered HTML template
     *
     * @return string
     */
    public function __toString(): string;
}
