<?php

namespace Cobra\View\Asset;

use Cobra\Html\HtmlScriptElement;
use Cobra\Interfaces\Server\Storage\FileSystemInterface;
use Cobra\Interfaces\View\Asset\ViewJavaScriptInterface;
use Cobra\Interfaces\View\ViewInterface;

/**
 * View JavaScript
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
class ViewJavaScript extends ViewAsset implements ViewJavaScriptInterface
{
    /**
     * Array of already loaded inline tags
     *
     * @var array
     */
    protected $inline = [];

    /**
     * Array of already loaded file tags
     *
     * @var array
     */
    protected $files = [];

    /**
     * Array of already loaded bundle tags
     *
     * @var array
     */
    protected $bundles = [];

    /**
     * FileSystemInterface instance
     *
     * @var FileSystemInterface
     */
    protected $fileSystem;

    /**
     * View instance
     *
     * @param ViewInterface $view
     * @param FileSystemInterface $fileSystem
     */
    public function __construct(ViewInterface $view, FileSystemInterface $fileSystem)
    {
        parent::__construct($view);

        $this->fileSystem = $fileSystem;
    }

    /**
     * Sets an inline script HTML tag
     *
     * @param  string $path
     * @param  array  $attributes
     * @return HtmlScriptElement
     */
    public function setInline(string $path, $attributes = []): HtmlScriptElement
    {
        if ($inline = array_key($path, $this->inline)) {
            return $inline;
        }
        $element = HtmlScriptElement::resolve()
            ->setAttributes(
                array_merge(
                    [
                        'nonce'  => nonce()
                    ],
                    $attributes
                )
            )
            ->setBody(path_join_root(PUBLIC_DIRECTORY, 'js', $path.'.js'));

        $this->view->getData()->setBodyTag($element);

        $this->inline[$path] = $element;

        return $element;
    }

    /**
     * Sets a JavaScript file HTML tag
     *
     * @param  string $src
     * @param  array  $attributes
     * @return HtmlScriptElement
     */
    public function setFile(string $src, $attributes = []): HtmlScriptElement
    {
        if ($file = array_key($src, $this->files)) {
            return $file;
        }
        $element = HtmlScriptElement::resolve()
            ->setAttributes(
                array_merge(
                    [
                        'src'  => $src
                    ],
                    $attributes
                )
            );

        $this->view->getData()->setBodyTag($element);

        $this->files[$src] = $element;

        return $element;
    }

    /**
     * Sets a JavaScript bundle file with cache busting
     *
     * @param  string $path
     * @return HtmlScriptElement
     */
    public function setBundle(string $path): HtmlScriptElement
    {
        if ($bundle = array_key($path, $this->bundles)) {
            return $bundle;
        }
        $element = HtmlScriptElement::resolve()
            ->setAttributes(
                [
                    'defer' => 'defer',
                    'src' => $this->getBundlePath($path)
                ]
            );

        $this->view->getData()->setBodyTag($element);

        $this->bundles[$path] = $element;

        return $element;
    }

    /**
     * Returns the URL path to a JavaScript bundle.
     *
     * @param  string $path
     * @return string
     */
    protected function getBundlePath(string $path): string
    {
        return sprintf(
            '/js/%s.%s.js',
            $path,
            $this->fileSystem->modified(
                path_join_root(PUBLIC_DIRECTORY, 'js', $path, 'js')
            )
        );
    }
}
