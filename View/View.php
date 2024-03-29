<?php

namespace Cobra\View;

use Cobra\Interfaces\View\Asset\ViewCssInterface;
use Cobra\Interfaces\View\Asset\ViewMetaInterface;
use Cobra\Interfaces\View\Asset\ViewJavaScriptInterface;
use Cobra\Interfaces\View\ViewDataInterface;
use Cobra\Interfaces\View\ViewInterface;
use Cobra\Object\AbstractObject;

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
     * @var ViewMetaInterface
     */
    protected $meta;

    /**
     * CSS instance
     *
     * @var ViewCssInterface
     */
    protected $css;

    /**
     * JavaScript instance
     *
     * @var ViewJavaScriptInterface
     */
    protected $javascript;

    /**
     * Sets the view data instances
     *
     * @param ViewDataInterface $data
     */
    public function __construct(ViewDataInterface $data)
    {
        $this->data = $data;

        $this->meta = container_resolve(
            ViewMetaInterface::class,
            [$this]
        );
        $this->css = container_resolve(
            ViewCssInterface::class,
            [$this]
        );
        $this->javascript = container_resolve(
            ViewJavaScriptInterface::class,
            [$this]
        );
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
     * @return ViewMetaInterface
     */
    public function meta(): ViewMetaInterface
    {
        return $this->meta;
    }

    /**
     * Returns the CSS instance
     *
     * @return ViewCssInterface
     */
    public function css(): ViewCssInterface
    {
        return $this->css;
    }

    /**
     * Returns the JavaScript instance
     *
     * @return ViewJavaScriptInterface
     */
    public function javascript(): ViewJavaScriptInterface
    {
        return $this->javascript;
    }
}
