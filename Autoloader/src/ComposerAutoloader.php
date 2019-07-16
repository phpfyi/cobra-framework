<?php

namespace Cobra\Autoloader;

use Composer\Autoload\ClassLoader;
use Cobra\Autoloader\Cache\AutoloaderCache;
use Cobra\Interfaces\Autoloader\ComposerAutoloaderInterface;
use Cobra\Object\AbstractObject;

/**
 * ComposerAutoloader
 *
 * Class which acts as a wrapper and allows easy interaction with the composer 
 * class loader.
 *
 * @category  Autoloader
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class ComposerAutoloader extends AbstractObject implements ComposerAutoloaderInterface
{
    /**
     * Composer class loader instance
     *
     * @var ClassLoader
     */
    protected $autoloader;

    /**
     * Autoloader cache class instance
     *
     * @var AutoloaderCache
     */
    protected $cache;
    
    /**
     * Sets the composer class loader instance to a class property
     *
     * @param ClassLoader $autoloader
     * @param AutoloaderCache $cache
     */
    public function __construct(ClassLoader $autoloader, AutoloaderCache $cache)
    {
        $this->autoloader = $autoloader;
        $this->cache = $cache;
    }

    /**
     * Runs the dump-autoload command
     *
     * @return void
     */
    public static function refresh()
    {
        exec('composer dump-autoload');
    }

    /**
     * Returns the class autoloader instance.
     *
     * @return ClassLoader
     */
    public function getAutoloader(): ClassLoader
    {
        return $this->autoloader;
    }

    /**
     * Gets the sub classes of a specific class in array format optionally
     * including the parent class.
     *
     * @param  string  $namespace
     * @param  boolean $parent
     * @return array
     */
    public function getSubclasses(string $namespace, $parent = false): array
    {
        return json_decode(
            $this->cache->find(
                $namespace.$parent,
                function () use ($parent, $namespace) {
                    return $this->getCacheCallback($namespace, $parent);
                }
            )->get()
        );
    }

    /**
     * Returns the JSON encoded sub class map cache data.
     *
     * @param  string  $namespace
     * @param  boolean $parent
     * @return string
     */
    protected function getCacheCallback(string $namespace, $parent = false): string
    {
        $classes = [];
        $map = $this->autoloader->getClassMap();
        array_map(
            function ($class, $path) use (&$classes, $namespace, $parent) {
                if (is_subclass_of($class, $namespace) || ($parent && $class === $namespace)) {
                    $classes[] = $class;
                }
            },
            array_keys($map),
            $map
        );
        return json_encode($classes, JSON_PRETTY_PRINT);
    }
}
