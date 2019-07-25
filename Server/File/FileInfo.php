<?php

namespace Cobra\Server\File;

use Cobra\Container\Traits\Resolvable;

/**
 * File Info
 *
 * @category  Server
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class FileInfo extends \SplFileInfo
{
    use Resolvable;
}
