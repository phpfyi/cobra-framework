<?php

namespace Cobra\Http\Content;

use Cobra\Interfaces\Http\Content\ContentInterface;
use Cobra\Object\AbstractObject;

/**
 * Content
 *
 * Abstract parent class to wrap content types for HTTP responses.
 *
 * Takes input (can be any data type, an array, string etc), and returns output
 * which can be the original data or in most cases; a transformed version.
 *
 * @category  HTTP
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
abstract class Content extends AbstractObject implements ContentInterface
{
    /**
     * Input content
     *
     * @var mixed
     */
    protected $input;

    /**
     * Returns HTTP safe string representation of the content.
     *
     * @return string
     */
    abstract public function __toString(): string;

    /**
     * Writes the input content into the object.
     *
     * @param mixed $input
     * @return ContentInterface
     */
    public function write($input): ContentInterface
    {
        $this->input = $input;
        return $this;
    }
}
