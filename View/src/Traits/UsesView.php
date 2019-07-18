<?php

namespace Cobra\View\Traits;

use Cobra\Interfaces\View\ViewInterface;

/**
 * Uses View trait
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
trait UsesView
{
    /**
     * ViewInterface instance
     *
     * @var ViewInterface
     */
    protected $view;

    /**
     * Sets the view instance
     *
     * @param  ViewInterface $view
     * @return static
     */
    public function setView(ViewInterface $view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * Returns the view instance
     *
     * @return ViewInterface
     */
    public function getView(): ViewInterface
    {
        return $this->view;
    }
}
