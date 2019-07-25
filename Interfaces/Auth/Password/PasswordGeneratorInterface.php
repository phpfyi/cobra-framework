<?php

namespace Cobra\Interfaces\Auth\Password;

/**
 * Password Generator Interface
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
interface PasswordGeneratorInterface
{
    /**
     * Returns a generated password string
     *
     * @param  integer $length
     * @return string
     */
    public function create(int $length = 14): string;
}
