<?php

namespace Cobra\View\Loader;

use Cobra\Interfaces\Server\File\FileSystemInterface;
use Cobra\Interfaces\View\Loader\ViewLoaderInterface;
use Cobra\Interfaces\View\Loader\ScopedLoaderInterface;
use Cobra\Interfaces\View\Transform\ViewParserInterface;
use Cobra\Interfaces\View\ViewDataInterface;
use Cobra\Event\Traits\EventEmitter;
use Cobra\Object\AbstractObject;
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
     * FileSystemInterface instance
     *
     * @var FileSystemInterface
     */
    protected $fileSystem;

    /**
     * Sets the base template path and data
     *
     * @param string $path
     * @param ViewDataInterface $data
     * @param ViewCache $cache
     * @param FileSystemInterface $fileSystem
     */
    public function __construct(
        string $path,
        ViewDataInterface $data,
        ViewCache $cache,
        FileSystemInterface $fileSystem
    ) {
        $this->template = path_join_root($path.'.'.TEMPLATE_EXTENSION);
        $this->data = $data;
        $this->cache = $cache;
        $this->fileSystem = $fileSystem;

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
                        $this->fileSystem->get($this->template)
                    ]
                )->getOutput();
            }
        );
        return container_resolve(ScopedLoaderInterface::class)->output(
            $this->cache->getFilePath($item->getKey()),
            $this->data
        );
    }
}
