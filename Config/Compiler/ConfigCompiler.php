<?php

namespace Cobra\Config\Compiler;

use Cobra\Config\Cache\ConfigCache;
use Cobra\Interfaces\Config\Compiler\ConfigCompilerInterface;
use Cobra\Object\AbstractObject;

/**
 * Config Compiler
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
abstract class ConfigCompiler extends AbstractObject implements ConfigCompilerInterface
{
    /**
     * ConfigCache instance
     *
     * @var ConfigCache
     */
    protected $cache;

    /**
     * Sets the required properties.
     *
     * @param ConfigCache  $cache
     * @param array  $directories
     */
    public function __construct(ConfigCache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Returns the complied config data.
     *
     * @return mixed
     */
    abstract public function compile();
}
