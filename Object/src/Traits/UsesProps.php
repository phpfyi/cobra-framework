<?php

namespace Cobra\Object\Traits;

use Cobra\Interfaces\Object\Props\PropsDataInterface;

/**
 * Object Props trait
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
trait UsesProps
{
    /**
     * Props data instance
     *
     * @var PropsDataInterface
     */
    protected $props;

    /**
     * Sets the props instance
     *
     * @param  PropsDataInterface props
     * @return object
     */
    public function setProps(PropsDataInterface $props): object
    {
        $this->props = $props;
        return $this;
    }

    /**
     * Returns the props instance
     *
     * @return PropsDataInterface|null
     */
    public function getProps():? PropsDataInterface
    {
        return $this->props;
    }
}
