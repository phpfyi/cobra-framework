<?php

namespace Cobra\Interfaces\Asset\Resource;

/**
 * File Resource Interface
 *
 * @category  Asset
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
interface FileResourceInterface
{
    /**
     * Outputs the file headers and response.
     *
     * @return void
     */
    public function output(): void;
}
