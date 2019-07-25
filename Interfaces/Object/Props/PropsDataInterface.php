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
     * Outputs the data values as a JSON object
     *
     * @return string
     */
    public function __toString(): string;
}
