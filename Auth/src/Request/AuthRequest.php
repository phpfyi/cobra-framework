<?php

namespace Cobra\Auth\Request;

use Cobra\Form\FormRequest;
use Cobra\Interfaces\Auth\AuthInterface;
use Cobra\Interfaces\Controller\Controller;
use Cobra\Interfaces\Form\Form;

/**
 * Auth Request
 *
 * @category  Auth
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
abstract class AuthRequest extends FormRequest
{
    /**
     * Auth instance
     *
     * @var Auth
     */
    protected $auth;

    /**
     * Sets the controller and form instances
     *
     * @param Controller $controller
     * @param Form       $form
     * @param AuthInterface $auth
     */
    public function __construct(Controller $controller, Form $form, AuthInterface $auth)
    {
        parent::__construct($controller, $form);

        $this->auth = $auth;
    }
}
