<?php

namespace Cobra\Validator\Traits;

/**
 * Uses Validators trait
 *
 * Allow the setting and getting of valdators on an object which has an array
 * of children instances.
 *
 * An example if a form instance which has field children.
 *
 * @category  Validator
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
trait UsesValidators
{
    /**
     * Sets validators on an object children.
     *
     * @param  string[]|Validator[] $validators
     * @return object
     */
    public function setValidators(array $validators): object
    {
        set_validators($this, $validators);
        return $this;
    }

    /**
     * Returns all validators set on an objects children.
     *
     * @return Validator[]
     */
    public function getValidators(): array
    {
        return get_validators($this);
    }
}
