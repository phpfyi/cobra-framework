<?php

namespace Cobra\View\Asset;

use Cobra\Html\HtmlStyleElement;

/**
 * View CSS
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
class ViewCss extends ViewAsset
{
    /**
     * Array of already loaded inline tags
     *
     * @var array
     */
    protected $inline = [];

    /**
     * Sets an inline CSS HTML tag
     *
     * @param  string $path
     * @param  array  $attributes
     * @return HtmlStyleElement
     */
    public function setInline(string $path, $attributes = []): HtmlStyleElement
    {
        if ($inline = array_key($path, $this->inline)) {
            return $inline;
        }
        $element = HtmlStyleElement::resolve()
            ->setAttributes(
                array_merge(
                    [
                        'nonce'  => nonce()
                    ],
                    $attributes
                )
            )
            ->setBody(path_with_root(PUBLIC_DIRECTORY, 'css', $path.'.css'));

        $this->view->getData()->setHeadTag($element);

        $this->inline[$path] = $element;
        
        return $element;
    }
}
