<?php

namespace Cobra\Interfaces\Form;

/**
 * Form Factory Interface
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
interface FormFactoryInterface
{
    /**
     * Returns the constructed form instance.
     *
     * @return FormInterface
     */
    public function getForm(): FormInterface;
}
