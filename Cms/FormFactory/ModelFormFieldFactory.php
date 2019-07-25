<?php

namespace Cobra\Cms\FormFactory;

use Cobra\Interfaces\Form\FormInterface;
use Cobra\Object\AbstractObject;

/**
 * Model Form Field Factory
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
abstract class ModelFormFieldFactory extends AbstractObject
{
    /**
     * The Form instance
     *
     * @var FormInterface
     */
    protected $form;

    /**
     * Array of form column schema
     *
     * @var array
     */
    protected $columns = [];

    /**
     * Sets the form and columns
     *
     * @param FormInterface  $form
     * @param array $columns
     */
    public function __construct(FormInterface $form, array $columns)
    {
        $this->form = $form;
        $this->columns = $columns;
    }

    /**
     * Pushes the fields to the form
     *
     * @return void
     */
    abstract public function pushToForm(): void;
}
