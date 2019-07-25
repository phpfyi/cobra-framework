<?php

namespace Cobra\View\Transform;

use Cobra\Interfaces\View\Transform\ViewMinifierInterface;

/**
 * View Minifier
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
class ViewMinifier extends ViewTransformer implements ViewMinifierInterface
{
    /**
     * Whether to minify output
     *
     * @var boolean
     */
    protected $minify = false;

    /**
     * Whether to compress output
     *
     * @var boolean
     */
    protected $compress = false;

    /**
     * Sets the required properites.
     *
     * @param string $input
     */
    public function __construct(string $input)
    {
        parent::__construct($input);

        $this->minify = (bool) config('view.minify');
        $this->compress = (bool) config('view.compress');
    }

    /**
     * Returns the minified template content.
     *
     * @return string
     */
    public function getOutput(): string
    {
        if ($this->minify === true) {
            $this->input = array_filter(
                array_map(
                    'ltrim',
                    explode("\n", $this->input)
                )
            );
            return implode(
                $this->compress === true ? '' : "\n",
                $this->input
            );
        }
        return $this->input;
    }
}
