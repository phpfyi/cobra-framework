<?php

namespace Cobra\Cms\FormFactory;

/**
 * Model Form Column Factory
 *
 * @category  CMS
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class ModelFormColumnFactory extends ModelFormFieldFactory
{
    /**
     * Array of database field to form elements
     *
     * @var array
     */
    protected $elements = [];

    /**
     * Pushed the fields to the form
     *
     * @return void
     */
    public function pushToForm(): void
    {
        $this->elements = static::config('mappings');
        array_map(
            function ($name, $column) {
                $element = $this->elements[$column->type];
                $this->form->setField($element::resolve($name));
            },
            array_keys($this->columns),
            $this->columns
        );
    }
}
