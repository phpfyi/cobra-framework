<?php

namespace Cobra\Interfaces\Object\Props;

/**
 * Props Data Interface
 *
 * @category  Object
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
interface PropsDataInterface
{
    /**
     * Sets a data values
     *
     * @param  string $name
     * @param  mixed  $value
     * @return self
     */
    public function set(string $name, $value): PropsDataInterface;

    /**
     * Returns a data value

     * @param  string $name
     * @return mixed
     */
    public function get(string $name);

    /**
     * Outputs the data values as a JSON object
     *
     * @return string
     */
    public function __toString(): string;
}
