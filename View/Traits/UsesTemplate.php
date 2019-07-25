<?php

namespace Cobra\View\Traits;

/**
 * Uses Template trait
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
trait UsesTemplate
{
    /**
     * Template file path
     *
     * @var string
     */
    protected $template;

    /**
     * Sets the template path
     *
     * @param  string $template
     * @return static
     */
    public function setTemplate(string $template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * Returns the template path
     *
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }
}
