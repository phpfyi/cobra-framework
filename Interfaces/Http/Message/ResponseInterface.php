<?php

namespace Cobra\Interfaces\Http\Message;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

/**
 * Response Interface
 *
 * @category  HTTP
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
interface ResponseInterface extends PsrResponseInterface
{
    /**
     * Outputs the HTTP response
     *
     * @return mixed
     */
    public function output();
}
