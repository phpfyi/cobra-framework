<?php

namespace Cobra\Amp\Form;

use Cobra\Form\Form;

/**
 * AMP Form
 *
 * @category  AMP
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class AmpForm extends Form
{
    /**
     * Sets up the default form attributes
     *
     * @param string      $name
     * @param string      $method
     * @param string|null $action
     */
    public function __construct(string $name, $method = 'POST', $action = null)
    {
        $this->method = $method;
        $this->attributes = [
            'name'       => $name,
            'method'     => $method,
            'action-xhr' => $action,
            'target'     => '_top',
            'id'         => 'form-'.$name,
            'class'      => 'form'
        ];
    }
}
