<?php

namespace Cobra\Form\Field;

use Cobra\Form\Field\FormField;

/**
 * Date Field
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
class DateField extends FormField
{
    /**
     * Default field parameters
     *
     * @var array
     */
    protected $attributes = [
        'type' => 'date'
    ];
}
