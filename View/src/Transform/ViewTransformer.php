<?php

namespace Cobra\View\Transform;

use Cobra\Object\AbstractObject;

/**
 * View Transformer
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
abstract class ViewTransformer extends AbstractObject
{
    /**
     * The input data
     *
     * @var string
     */
    protected $input;

    /**
     * Sets the input data.
     *
     * @param string $input
     */
    public function __construct(string $input)
    {
        $this->input = $input;
    }

    /**
     * Returns the rendered content.
     *
     * @return string
     */
    abstract public function getOutput(): string;
}
