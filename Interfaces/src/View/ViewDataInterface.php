<?php

namespace Cobra\Interfaces\View;

use Cobra\Interfaces\Html\HtmlElementInterface;

/**
 * View Data interface
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
interface ViewDataInterface
{
    /**
     * Returns a template data property
     *
     * @param  mixed $name
     * @return void
     */
    public function __get(string $name);

    /**
     * Sets a heada tag
     *
     * @param  HtmlElementInterface $element
     * @return ViewDataInterface
     */
    public function setHeadTag(HtmlElementInterface $element): ViewDataInterface;

    /**
     * Sets a body tag
     *
     * @param  HtmlElementInterface $element
     * @return ViewDataInterface
     */
    public function setBodyTag(HtmlElementInterface $element): ViewDataInterface;

    /**
     * Includes a template file and passes template data
     *
     * @param  string            $template
     * @param  ViewDataInterface $data
     * @return void
     */
    public function include(string $template, ViewDataInterface $data = null): void;

    /**
     * Outputs this view data instance inside a specified template
     *
     * @param  string $template
     * @return string
     */
    public function withTemplate(string $template): string;
}
