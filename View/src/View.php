<?php

namespace Cobra\View;

use Cobra\Interfaces\View\ViewDataInterface;
use Cobra\Interfaces\View\ViewInterface;
use Cobra\Object\AbstractObject;
use Cobra\View\Asset\ViewCss;
use Cobra\View\Asset\ViewMeta;
use Cobra\View\Asset\ViewJavaScript;

/**
 * View
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
class View extends AbstractObject implements ViewInterface
{
    /**
     * ViewDataInterface instance
     *
     * @var ViewDataInterface
     */
    protected $data;

    /**
     * Meta instance
     *
     * @var ViewMeta
     */
    protected $meta;

    /**
     * CSS instance
     *
     * @var ViewCss
     */
    protected $css;

    /**
     * JavaScript instance
     *
     * @var ViewJavaScript
     */
    protected $js;

    /**
     * Sets the view data instances
     *
     * @param ViewDataInterface $data
     */
    public function __construct(ViewDataInterface $data)
    {
        $this->data = $data;

        $this->meta = ViewMeta::resolve($this);
        $this->css = ViewCss::resolve($this);
        $this->js = ViewJavaScript::resolve($this);
    }

    /**
     * Sets the view page data property
     *
     * @param  string $page
     * @return ViewInterface
     */
    public function setPage(string $page): ViewInterface
    {
        $this->data->set('page', $page);
        return $this;
    }

    /**
     * Sets a view data property
     *
     * @param  string $name
     * @param  mixed  $value
     * @return ViewInterface
     */
    public function setData(string $name, $value): ViewInterface
    {
        $this->data->set($name, $value);
        return $this;
    }

    /**
     * Returns the view data instance
     *
     * @return ViewDataInterface
     */
    public function getData(): ViewDataInterface
    {
        return $this->data;
    }

    /**
     * Returns the Meta instance
     *
     * @return ViewMeta
     */
    public function meta(): ViewMeta
    {
        return $this->meta;
    }

    /**
     * Returns the CSS instance
     *
     * @return ViewCss
     */
    public function css(): ViewCss
    {
        return $this->css;
    }

    /**
     * Returns the JavaScript instance
     *
     * @return ViewJavaScript
     */
    public function js(): ViewJavaScript
    {
        return $this->js;
    }
}
