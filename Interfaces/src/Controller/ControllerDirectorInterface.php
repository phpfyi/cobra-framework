<?php

namespace Cobra\Interfaces\Controller;

/**
 * Controller Director Interface
 *
 * @category  Controller
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
interface ControllerDirectorInterface
{
    /**
     * Called before the controller action
     *
     * @return void
     */
    public function beforeAction(): void;

    /**
     * Called after the controller action
     *
     * @return void
     */
    public function afterAction(): void;
}
