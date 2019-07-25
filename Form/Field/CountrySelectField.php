<?php

namespace Cobra\Form\Field;

use Cobra\Form\Field\SelectField;
use Cobra\i18n\Localisation;

/**
 * Country Select Field
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
class CountrySelectField extends SelectField
{
    /**
     * Empty option text
     *
     * @var string
     */
    protected $emptyOption = '- select country -';

    /**
     * Sets name, label, and value
     *
     * @param string $name
     * @param string $label
     * @param mixed  $value
     */
    public function __construct(string $name, $label = '', $value = null)
    {
        parent::__construct($name, $label, $value);

        $this->data = array_combine_from(Localisation::getCountries());
    }
}
