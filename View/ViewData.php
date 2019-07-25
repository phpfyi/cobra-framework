<?php

namespace Cobra\View;

use Cobra\Interfaces\Html\HtmlElementInterface;
use Cobra\Interfaces\View\Loader\ViewLoaderInterface;
use Cobra\Interfaces\View\ViewDataInterface;
use Cobra\Object\AbstractObject;
use Cobra\Object\Traits\DataStore;

/**
 * View Data
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
class ViewData extends AbstractObject implements ViewDataInterface
{
    use DataStore;

    /**
     * Array of head meta tags
     *
     * @var array
     */
    public $headTags = [];

    /**
     * Array of body script tags
     *
     * @var array
     */
    public $bodyTags = [];

    /**
     * Returns a template data property
     *
     * @param  mixed $name
     * @return void
     */
    public function __get(string $name)
    {
        return $this->data[$name];
    }

    /**
     * Sets a heada tag
     *
     * @param  HtmlElementInterface $element
     * @return ViewDataInterface
     */
    public function setHeadTag(HtmlElementInterface $element): ViewDataInterface
    {
        $this->headTags[] = $element;
        return $this;
    }

    /**
     * Sets a body tag
     *
     * @param  HtmlElementInterface $element
     * @return ViewDataInterface
     */
    public function setBodyTag(HtmlElementInterface $element): ViewDataInterface
    {
        $this->bodyTags[] = $element;
        return $this;
    }

    /**
     * Outputs this view data instance inside a specified template
     *
     * @param  string $template
     * @return string
     */
    public function withTemplate(string $template): string
    {
        return container_resolve(
            ViewLoaderInterface::class,
            [
                $template,
                $this
            ]
        )->getOutput();
    }
}
