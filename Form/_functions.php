<?php

use Cobra\Interfaces\Form\FormInterface;

/**
 * Form function sets
 *
 * @category  Form
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */

if (! function_exists('label_text')) {
    /**
     * Returns a special character free words string
     *
     * @param  string $text
     * @return string
     */
    function label_text(string $text): string
    {
        return str_replace(['_', '-'], ' ', ucfirst($text));
    }
}

if (! function_exists('set_form_values')) {
    /**
     * Sets values across multiple form fields
     *
     * @param FormInterface $form
     * @param array $values
     * @return void
     */
    function set_form_values(FormInterface $form, array $values): void
    {
        array_map(
            function ($field) use ($values) {
                if (array_key_exists($field->getName(), $values)) {
                    $field->setValue($values[$field->getName()]);
                }
            },
            $form->getFields()
        );
    }
}
