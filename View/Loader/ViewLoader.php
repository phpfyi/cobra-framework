<?php

namespace Cobra\View\Loader;

use Cobra\Interfaces\View\Loader\ViewLoaderInterface;
use Cobra\Interfaces\View\Transform\ViewParserInterface;
use Cobra\Event\Traits\EventEmitter;
use Cobra\Object\AbstractObject;
use Cobra\Server\File\FileSystem;
use Cobra\View\Cache\ViewCache;

/**
 * View Loader
 *
 * @category  View
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class ViewLoader extends AbstractObject implements ViewLoaderInterface
{
    use EventEmitter;

    /**
     * Template path
     *
     * @var string
     */
    protected $template;

    /**
     * Template data object
     *
     * @var object
     */
    protected $data;

    /**
     * View cache instance
     *
     * @var ViewCache
     */
    protected $cache;

    /**
     * Sets the base template path and data
     *
     * @param string $path
     * @param mixed $data
     * @param ViewCache $cache
     */
    public function __construct(string $path, $data, ViewCache $cache)
    {
        $this->template = path_with_root($path.'.'.TEMPLATE_EXTENSION);
        $this->data = $data;
        $this->cache = $cache;

        $this->emit('LoadingTemplate', $path);
    }

    /**
     * Checks the cache for a template and returns it if found.
     *
     * If not found then the template is created and sent to the cache;
     *
     * @return string
     */
    public function getOutput(): string
    {
        // push to view cache if needed
        $item = $this->cache->find(
            $this->template,
            function () {
                return container_resolve(
                    ViewParserInterface::class,
                    [
                        FileSystem::get($this->template)
                    ]
                )->getOutput();
            }
        );
        return ViewScopedLoader::output(
            $this->cache->getFilePath($item->getKey()),
            $this->data
        );
    }
}
