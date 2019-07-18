<?php

namespace Cobra\Html\Traits;

use Cobra\Interfaces\View\Loader\ViewScopedLoaderInterface;

/**
 * Renders File in Body Trait
 *
 * Loads a files contents into the body of a HTML tag
 * Overrides @method getBody()
 *
 * @category  HTML
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
trait RendersFileInBody
{
    /**
     * Gets a files contents for use as the HTML element body
     * An example is a <style> tag; CSS content is loaded from a file
     *
     * @return string
     */
    public function getBody(): string
    {
        if (!$this->body) {
            return '';
        }
        return container_resolve(ViewScopedLoaderInterface::class)->output($this->body);
    }
}
