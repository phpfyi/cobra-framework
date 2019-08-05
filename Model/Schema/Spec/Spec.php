<?php

namespace Cobra\Model\Schema\Spec;

use Cobra\Object\AbstractObject;

/**
 * Spec
 *
 * @category  Model
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
abstract class Spec extends AbstractObject
{
    /**
     * Spec object to assign data to.
     *
     * @var object
     */
    protected $spec;

    /**
     * Base schmea class instance
     *
     * @var object
     */
    protected $baseClass;

    /**
     * Array of all parent classes
     *
     * @var array
     */
    protected $parentClasses = [];

    /**
     * Array of all hierarchy classes
     *
     * @var array
     */
    protected $classes = [];

    /**
     * Sets the required properties
     *
     * @param object $spec
     * @param object $baseClass
     * @param array $parentClasses
     */
    public function __construct(object $spec, object $baseClass, array $parentClasses)
    {
        $this->spec = $spec;
        $this->baseClass = $baseClass;
        $this->parentClasses = $parentClasses;

        $this->classes = array_merge(
            [
                $this->baseClass
            ],
            $this->parentClasses
        );
    }

    /**
     * Assigns the spec data
     *
     * @return void
     */
    abstract public function assign(): void;
}
