<?php

namespace Cobra\Interfaces\Asset;

use Cobra\Http\Stream\FileStream;

/**
 * File Interface
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
interface FileInterface
{
    /**
     * Returns the system file instance
     *
     * @return FileStream
     */
    public function getResource(): FileStream;
}
