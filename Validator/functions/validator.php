<?php
/**
 * Validator function sets
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

if (! function_exists('set_validators')) {
    /**
     * Sets validators across multiple object fields
     *
     * @param object $object
     * @param array $validators
     * @return void
     */
    function set_validators(object $object, array $validators): void
    {
        array_map(
            function ($element, $validator) use ($object) {
                $object->getElement($element)->setValidator($validator);
            },
            array_keys($validators),
            $validators
        );
    }
}

if (! function_exists('get_validators')) {
    /**
     * Return all validators on an object
     *
     * @param object $object
     * @return array
     */
    function get_validators(object $object): array
    {
        $validators = [];
        array_map(
            function ($name, $element) use (&$validators) {
                if (method_exists($element, 'getValidator')) {
                    $validators[$element->getName()] = $element->getValidator();
                }
            },
            array_keys($object->getElements()),
            $object->getElements()
        );
        return array_filter($validators);
    }
}
