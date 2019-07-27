<?php

namespace Cobra\View\Traits;

use Cobra\Interfaces\View\ViewDataInterface;

/**
 * Renders Template trait
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
trait RendersTemplate
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function getHTML()
    {
        return parent::__toString();
    }

    /**
     * Returns the rendered HTML template
     *
     * @return string
     */
    public function __toString(): string
    {
        return container_resolve(
            ViewDataInterface::class,
            [
                $this->getViewData()
            ]
        )->withTemplate($this->template);
    }
}
