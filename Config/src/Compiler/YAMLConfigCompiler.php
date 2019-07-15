<?php

namespace Cobra\Config\Compiler;

use Closure;
use Cobra\Config\Cache\ConfigCache;
use Cobra\Server\DirectoryIterator;

/**
 * YAML Config Compiler
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
class YAMLConfigCompiler extends ConfigCompiler
{
    /**
     * Array of directories to compile
     *
     * @var array
     */
    protected $directories = [];

    /**
     * Regex file pattern to match
     *
     * @var string
     */
    protected $pattern =  '/^.+\.yml$/i';

    /**
     * Compiled config array
     *
     * @var array
     */
    protected $config = [];

    /**
     * Sets the required properties.
     *
     * @param ConfigCache  $cache
     * @param array  $directories
     */
    public function __construct(ConfigCache $cache, array $directories = null)
    {
        parent::__construct($cache);

        $this->directories = $directories ?? CONFIG_DIRECTORIES;
    }

    /**
     * Returns the complied config data.
     *
     * @return mixed
     */
    public function compile()
    {
        return $this->cache->find(
            'config',
            $this->getCacheCallback()
        )->get();
    }

    /**
     * Returns the closure to build the config data for the cache.
     *
     * @return Closure
     */
    protected function getCacheCallback(): Closure
    {
        return function () {
            array_map(
                function ($directory) {
                    array_map(
                        function ($path) {
                            $config = yaml_parse_file($path);
                            $this->config = array_key_exists('routes', $config)
                            ? array_merge_recursive($this->config, $config)
                            : array_replace_recursive($this->config, $config);
                        },
                        DirectoryIterator::match($directory, $this->pattern)
                    );
                },
                $this->directories
            );
            return yaml_emit($this->config);
        };
    }
}
