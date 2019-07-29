<?php

namespace Cobra\Interfaces\Http\Factory;

use Cobra\Http\Stream\HtmlStream;
use Cobra\Http\Stream\JsonStream;
use Cobra\Http\Stream\XmlStream;

/**
 * Content Factory Interface
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
interface ContentFactoryInterface
{
    /**
     * Returns a HtmlStream object.
     *
     * @param string $output
     * @return HtmlStream
     */
    public function html(string $output): HtmlStream;

    /**
     * Returns a JsonStream object.
     *
     * @param string $output
     * @return JsonStream
     */
    public function json(array $output): JsonStream;

    /**
     * Returns a XmlStream object.
     *
     * @param string $output
     * @return XmlStream
     */
    public function xml(string $output): XmlStream;
}
