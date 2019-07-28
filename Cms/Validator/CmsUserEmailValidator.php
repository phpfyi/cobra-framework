<?php

namespace Cobra\Cms\Validator;

use Cobra\Auth\Validator\UserEmailValidator;
use Cobra\Interfaces\Auth\User\UserInterface;
use Cobra\Interfaces\Controller\ControllerInterface;

/**
 * CMS User Email Validator
 *
 * Checks when editing a CMS user record that the submitted email belongs to the
 * user being edited.
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
class CmsUserEmailValidator extends UserEmailValidator
{
    /**
     * Sets the required properties
     *
     * @param ControllerInterface $controller
     */
    public function __construct(ControllerInterface $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'cms-user-email';
    }

    /**
     * Main method to validate the passed value
     *
     * @param  mixed $value
     * @return bool
     */
    public function validate($value): bool
    {
        if ($user = container_resolve(UserInterface::class)->find('email', $value)) {
            if ($user->id == $this->controller->getUrlParser()->getRecord()->id) {
                return true;
            }
        }
        return parent::validate($value);
    }
}
