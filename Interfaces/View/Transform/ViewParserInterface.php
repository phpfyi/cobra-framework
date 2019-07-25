<?php

namespace Cobra\Interfaces\View\Transform;

/**
 * View Parser Interface
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
interface ViewParserInterface
{
    /**
     * Returns the parsed template content.
     *
     * @return string
     */
    public function getOutput(): string;
}
