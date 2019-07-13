<?php

namespace Cobra\Interfaces\Validator;

/**
 * Validator Resolver Interface
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
interface ValidatorResolverInterface
{
    /**
     * Returns a validator instance based on a string identifier.
     *
     * @param string $name
     * @return ValidatorInterface
     * @throws InvalidClassnameException
     */
    public function get(string $name): ValidatorInterface;
}
