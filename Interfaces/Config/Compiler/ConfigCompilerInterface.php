<?php

namespace Cobra\Interfaces\Config\Compiler;

/**
 * Config Compiler Interface
 *
 * @category  Config
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
interface ConfigCompilerInterface
{
    /**
     * Returns the complied config data.
     *
     * @return mixed
     */
    public function compile();
}
