<?php

namespace Cobra\Object\Props;

use Cobra\Interfaces\Object\Props\PropsDataInterface;
use Cobra\Object\AbstractObject;
use Cobra\Object\Traits\DataStore;

/**
 * Object Props Data
 *
 * JSON data schema for an object
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
class PropsData extends AbstractObject implements PropsDataInterface
{
    use DataStore;

    /**
     * Outputs the data values as a JSON object
     *
     * @return string
     */
    public function __toString(): string
    {
        return htmlspecialchars(json_encode($this->data, JSON_FORCE_OBJECT), ENT_QUOTES, 'UTF-8');
    }
}
